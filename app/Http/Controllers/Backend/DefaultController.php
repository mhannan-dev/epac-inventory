<?php

namespace App\Http\Controllers\Backend;
use App\Models\Unit;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class DefaultController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function getProduct(Request $request){

        $supplier_id = $request->supplier_id;
        $all_product = Product::where('supplier_id',$supplier_id)->get();
        //dd($all_product->toArray());
        return response()->json($all_product);
    }


    public function categoryForInvoice(Request $request)
    {
        $r_brand_id = $request->brand_id;
        $allCategory = Product::with('category')->select('category_id')->where('brand_id',$r_brand_id)->groupBy('category_id')->get();
        //dd($allCategory);
        return response()->json($allCategory);
    }



    public function getUnits(Request $request){
        $r_product_id = $request->product_id;
        //dd($r_product_id);
        //$allUnits = Product::select('unit_id')->where('id',$r_product_id)->first();
        $allUnits = Product::select('unit_id')->where('id',$r_product_id)->first();
        $allUnits = Unit::select('id','name')->where('id',$allUnits->unit_id)->get();
        //dd($allUnits->toArray());
        return response()->json($allUnits);
    }


    public function getStock(Request $request){
        $r_product_id = $request->product_id;
        $stock = Product::where('id',$r_product_id)->first()->quantity;
        //dd($stock);
        return response()->json($stock);
    }

    public function get_unit_price(Request $request){
        $r_product_id = $request->product_id;
        $unit_price = Purchase::where('id',$r_product_id)->first()->unit_price;
        return response()->json($unit_price);
    }
    public function unit_selling_price(Request $request){
        $r_product_id = $request->product_id;
        //dd($r_product_id);
        $unt_sell_price = Purchase::where('id',$r_product_id)->first()->unt_sell_price;
        //dd($unt_sell_price);
        return response()->json($unt_sell_price);
    }

    public function getProductById(Request $request){
        try {
            $product = Product::findOrFail($request->product_id);
            $data['unit'] = $product->units->name;
            $data['unitPrice'] = $product->unitPrice;
            $data['stock'] = $product->stock;
            $data['unitSellingPrice'] = $product->unitSellingPrice;
            return response()->json([
                'status' => 1,
                'message' => 'Product Data Found',
                'data' => $data
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 0,
                'message' => 'Product Data Not Found',
                'data' => []
            ]);
        }
    }

 
}
