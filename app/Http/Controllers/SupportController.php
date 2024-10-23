<?php

namespace App\Http\Controllers;

use App\Models\GetItTach;
use Illuminate\Http\Request;

class SupportController extends Controller
{

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|max:15|min:11',
            'message' => 'required'
        ]);

        GetItTach::create($data);
        return response()->json('Successfully Sent...');
    }
}
