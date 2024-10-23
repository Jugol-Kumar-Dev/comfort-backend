<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductStock;
use Carbon\Carbon;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $orders = Order::query()->with(['orderdetails', 'orderdetails.product', 'orderdetails.product.images', 'orderdetails.stoke'])
            ->where('user_id', $user->id)
            ->paginate(10);

        return response()->json([
            'message' => 'users all orders',
            'data' => $orders
        ]);
    }

    public function store(Request $request)
    {

        if (Auth::check()) {

            $request->validate([
                'addressId' => 'required',
                'paymentMethod' => 'required',
                'orderTotal' => 'required',
                'orders' => 'required|array',
                'orders.*.data.id' => 'required|exists:products,id',
                'orders.*.selectSku.id' => 'required|exists:product_stocks,id',
            ], [
                'orders.*.data.id.required' => 'The product  ID is required for each order',
                'orders.*.data.id.exists' => 'The selected product ID does not exist.',
                'orders.*.selectSku.required' => 'The SKU selection is required for each order.',
                'orders.*.selectSku.id.exists' => 'The selected SKU ID does not exist.',
            ]);

            $address = Address::with('orderArea')->findOrFail($request->addressId);
            $grandTotal = $address->orderArea->delivery_charge + $request->orderTotal;


            $order = Order::create([
                'transaction_id' => getRandomStringRand(16),
                'user_id' => $request->user()->id,
                'address_id' => $request->input('addressId'),
                'payment_method' => $request->input('paymentMethod'),
                'sub_total' => $request->orderTotal,
                'grand_total' => $grandTotal,
                'order_date' => Carbon::now(),
            ]);

            $orderDetails = [];
            foreach ($request->orders as $key => $item) {
                $orderDetails[] = [
                    'order_id' => $order->id,
                    'product_id' => $item['data']['id'],
                    'product_stock_id' => (!empty($item["selectSku"]) && !empty($item["selectSku"]["id"])) ? $item["selectSku"]["id"] : NULL,
                    'quantity' => $item["selectSku"]["selectQty"] ?? 1
                ];
                if (!empty($item["selectSku"]) && !empty($item["selectSku"]["id"])) {
                    $stock = ProductStock::where('id', $item["selectSku"]["id"])->first();
                    if ($stock) {
                        $stock->qty = $stock->qty - $item["selectSku"]["selectQty"];
                        $stock->save();
                    }
                }
                if (!empty($item["selectSku"]) && !empty($item["selectSku"]["sku"])) {
                    $product = Product::query()->whereSku($item["selectSku"]["sku"])->first();
                    if ($product) {
                        $product->stock = $product->stock - $item["selectSku"]["selectQty"];
                        $product->save();
                    }
                }
            }
            $order->orderdetails()->createMany($orderDetails);

            if ($request->input('paymentMethod') == 'stripe') {
                $stripe = new StripeController();

                $session = $stripe->checkout($order, $orderDetails);
                $order->transaction_id = $session->id;
                $order->save();

                return response()->json([
                    'type' => 'stripe_payment',
                    'message' => 'Order save successfully done.',
                    'data' => $session->url,
                ], 200);
            } else {
                return response()->json([
                    'type' => 'cache_on_delivery',
                    'message' => 'Order save successfully done.',
                    'data' => $order,
                ], 200);
            }
        }

        throw new AuthenticationException();

    }

    public function show(Order $order)
    {
        return response()->json(Order::find('id', $order->id)->with('orderdetails')->first());
    }

    public function orderDetails($id)
    {
        $order = Order::with(['orderdetails', 'orderdetails.product', 'orderdetails.stoke', 'customer', 'address.orderArea'])->findOrFail($id);
        return response()->json($order, 200);
    }

    public function update(Request $request, Order $order)
    {
        //
    }

    public function destroy(Order $order)
    {
        $order->orderdetails()->delete();
        $order->delete();
        return response()->json("Order Deleted...", 200);
    }


    public function changeOrderStatus(Request $request)
    {
        $order = Order::findOrFail($request->id);
        if ($request->input('type') == 'payment') {
            $order->payment_status = Str::lower($request->input('status'));
        } else {
            $order->order_status = Str::lower($request->input('status'));
        }
        $order->update();

        return response()->json(['message' => 'Status Updated...']);
    }

    public function changePaymentStatus()
    {
        return dd(\request()->all());
    }


}
