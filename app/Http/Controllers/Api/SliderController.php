<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response() ->json(Slider::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $path = null;
        if (\Illuminate\Support\Facades\Request::hasFile('image')){
            $file =  \Illuminate\Support\Facades\Request::file('image');
            $path = $file->store('/uploads');
        }
        if(empty($path)){
            $request->validate([
                'image' => 'required'
            ]);
        }

        Slider::create([
            'image' => $path,
            'link'  => $request->input('url'),
        ]);

        return response()->json('Slider Created...');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        Slider::findOrFail($id)->delete();
        return response()->json('Slider Deleted...');
    }
}
