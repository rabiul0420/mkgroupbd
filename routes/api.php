<?php

use App\Models\OurService;
use Illuminate\Http\Request;
use App\Models\SisterConcern;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/view-service-details/{id}',function($id) {
    $data = OurService::find($id);
    if(isset($data)) {
        return response()->json([
            'type' => 'success',
            'heading' => $data->name,
            'content' => html_entity_decode($data->description)
        ]);
    } else {
        return response()->json([
            'type' => 'error'
        ]);
    }
});

Route::get('/view-sister-concern-details/{id}',function($id) {
    $data = SisterConcern::find($id);
    if(isset($data)) {
        return response()->json([
            'type' => 'success',
            'heading' => $data->name,
            'content' => html_entity_decode($data->description)
        ]);
    } else {
        return response()->json([
            'type' => 'error'
        ]);
    }
});

Route::get('/get-product-record/{product_id}',function ($product_id) {
    $product = \App\Models\Product::findOrFail($product_id);
        return view('admin.invoice.product_show',compact('product'));
});

