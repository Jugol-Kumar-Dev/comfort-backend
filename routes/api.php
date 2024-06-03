<?php

use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\AdminOrderController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\BusinessSettingController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\EmailToolsController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\ExpenseController;
use App\Http\Controllers\Api\MonthController;
use App\Http\Controllers\Api\OrderAreaController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\Api\PosController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\SalaryController;
use App\Http\Controllers\Api\SliderController;
use App\Http\Controllers\Api\StripeController;
use App\Http\Controllers\Api\SupplierController;
use App\Http\Controllers\Api\VariationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'prefix' => 'auth',
], function (){
    Route::post('login',    [AuthController::class, 'login']);
    Route::post('logout',   [AuthController::class, 'logout']);
    Route::post('refresh',  [AuthController::class, 'refresh']);
    Route::post('me',       [AuthController::class, 'me']);
    Route::post('payload',  [AuthController::class, 'payload']);
    Route::post('register', [AuthController::class, 'register']);
});


Route::get('dashboard-report', [DashboardController::class, 'index']);


Route::apiResource('employee',  EmployeeController::class);

Route::apiResource('supplier',  SupplierController::class);

Route::apiResource('category',  CategoryController::class); //->only(['index', 'show', 'store', 'destroy']);
Route::post('/category/update/{id}', [CategoryController::class, 'updateCategory']);

Route::get("/navbar-categories", [CategoryController::class, 'navCategories']);
Route::get("/navbar-pages", [PageController::class, 'navPages']);

Route::get("/get-setting/{key}", fn($key)=> get_setting($key));

Route::get("/home-categories", [CategoryController::class, 'homeCategories']);

Route::apiResource('brand',     BrandController::class);
Route::post('/brand/update/{id}', [BrandController::class, 'updateBrand']);

Route::apiResource('product',   ProductController::class);
Route::get('product-filter', [ProductController::class, 'filterProduct']);

Route::apiResource('expense',   ExpenseController::class);

Route::apiResource('salary',    SalaryController::class);

Route::apiResource('customer',  CustomerController::class);
//Route::post('/update-customer/${id}',  [CustomerController::class, 'update']);

Route::post('/customer/profile-update', [CustomerController::class, 'updateProfile']);
Route::post('/customer/update-password', [CustomerController::class, 'updatePassword']);

Route::apiResource('pos',       PosController::class);

Route::apiResource('order',     OrderController::class);
Route::get('/order-details/{id}', [OrderController::class, 'orderDetails']);

Route::get("/change-order-status", [OrderController::class, 'changeOrderStatus']);
Route::get("/change-payment-status", [OrderController::class, 'changePaymentStatus']);





Route::delete('/pos/delete-cart/{id}',          [PosController::class, 'deleteItem']);

Route::get('/pos/increment-cart-product/{id}',  [PosController::class, 'incrementProductQty']);
Route::get('/pos/decrement-cart-product/{id}',  [PosController::class, 'decrementProductQty']);

Route::get('/month-salaries/{id}',              [SalaryController::class, 'monthSalary']);
Route::get('/all-month',                        [MonthController::class, 'index']);
Route::get('/employee-salary/{id}',             [MonthController::class, 'employeeSalary']);
Route::get('/product-by-category-id/{id}',      [ProductController::class, 'productByCategory']);




Route::get('varients', [VariationController::class, 'index']);
Route::post('create-varient', [VariationController::class, 'store']);



Route::post('varient-product', [ProductController::class, 'checkVarient']);

Route::post('save-product-details', [ProductController::class, 'saveProductDetails']);
Route::post('save-product-variations', [ProductController::class, 'saveProductVariations']);
Route::post('save-product-images', [ProductController::class, 'saveProductImages']);
Route::get('product-with-variations', [ProductController::class, 'variationsProducts']);
Route::delete('delete-product-image/{id}', [ProductController::class, 'deleteProductImage']);
Route::delete('/delete-product-stoke/{id}', [ProductController::class, 'deleteStoke']);


Route::get('/admin/pos-products', [ProductController::class, 'posProducts']);

Route::get('/admin/delete-area/{id}', [OrderAreaController::class, 'destroy']);

Route::post("/admin/save-setting", [BusinessSettingController::class, 'updateSetting']);
Route::get("/admin/get-setting", [BusinessSettingController::class, 'index']);

Route::post('login', [CustomerController::class, 'loginCustomer']);
Route::post('register', [CustomerController::class, 'store']);
Route::post('/forgot-password', [CustomerController::class, 'sendForgotPasswordReqs']);
Route::get('/forgot-password-notification', [CustomerController::class, 'checkForgotPassword'])->name('api.forgotPasswordEmail');
Route::post('/save-new-password', [CustomerController::class, 'saveNewChangedPassword'])->name('api.saveNewChangedPassword');






Route::get('/all-areas', [OrderAreaController::class, 'getAreas']);
Route::post('/save-new-address', [OrderAreaController::class, 'saveAddress']);


//review system routes
Route::apiResource('/review', ReviewController::class);
//question system routes
Route::apiResource('/question', QuestionController::class);

Route::get('/get-customers-emails', [EmailToolsController::class, 'index']);
Route::post('/send-emails', [EmailToolsController::class, 'sendEmails']);
Route::get('/get-all-campaign', [EmailToolsController::class, 'getCampaign']);
Route::delete('/delete-campaign/{id}', [EmailToolsController::class, 'deleteCampaign']);

// page management
Route::resource('pages', PageController::class);
Route::post('/pages/update/{id}', [PageController::class, 'updatePage'])->name('pages.updatePage');

// slider management
Route::resource('/sliders', SliderController::class);


// get settings for frontend
Route::get('/get-footer-settings', [BusinessSettingController::class, 'getFooterSettings']);

Route::middleware('auth:sanctum')->group(function(){
    Route::get('user', function (Request $request){
        return $request->user();
    });

    Route::apiResource('address', AddressController::class);

    Route::post("save-order", [OrderController::class, 'store']);
    Route::get("my-orders", [OrderController::class, 'index']);
    Route::get('auth-data',  [ProductController::class, 'variationsProducts']);



    // admin router
    Route::get('/admin/orders', [AdminOrderController::class, 'index']);
    Route::get('/admin/product-stokes', [ProductController::class, 'stokeProducts']);
    Route::put('/admin/update-stokes/{id}', [ProductController::class, 'updateStoke']);


    Route::get('/admin/areas', [OrderAreaController::class, 'index']);
    Route::post('/admin/areas-save', [OrderAreaController::class, 'store']);

    Route::get('logout', [CustomerController::class, 'logoutCustomer']);
});


Route::post('/checkout', [StripeController::class, 'checkout'])->name('checkout');
Route::post('/verify', [StripeController::class, 'verify'])->name('verify');
Route::get('/success', [StripeController::class, 'index'])->name('success');
Route::get('/cancel', [StripeController::class, 'cancel'])->name('cancel');


Route::post('save/emp', [EmployeeController::class, 'saveEmp']);

Route::get("/storage", function (){
    \Illuminate\Support\Facades\Artisan::call('storage:link');
    return "storage linked";
});
