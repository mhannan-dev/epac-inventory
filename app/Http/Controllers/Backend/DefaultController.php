<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\SubCategory;
use Illuminate\Http\Request;

use App\Models\Unit;
use Validator;


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


    // public function getCategory(Request $request)
    // {
    //     $r_supplier_id = $request->supplier_id;
    //     $allCategory = Product::with('category')->select('category_id')->where('supplier_id',$r_supplier_id)->groupBy('category_id')->get();
    //     return response()->json($allCategory);
    // }

    public function categoryForInvoice(Request $request)
    {
        $r_brand_id = $request->brand_id;
        $allCategory = Product::with('category')->select('category_id')->where('brand_id',$r_brand_id)->groupBy('category_id')->get();
        //dd($allCategory);
        return response()->json($allCategory);
    }



    public function getUnits(Request $request){
        $r_product_id = $request->product_id;
        $allUnits = Product::select('unit_id')->where('id',$r_product_id)->first();
        dd($allUnits->toArray());
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
        //dd($unit_price);
        return response()->json($unit_price);
    }

    


//    public function getSubCategory(Request $request){
//        if(empty($request->cat_id)){
//            return response()->json(['status' => false , 'message' => 'Category ID Not found', 'data' => [] ]);
//        }
//        $data = SubCategory::select('id','name')->where('category_id',$request->cat_id)->get();
//        if(count($data)){
//            return response()->json(['status' => true , 'message' => 'Sub Category found', 'data' => $data]);
//        }else{
//            return response()->json(['status' => false , 'message' => 'Sub Category Not found', 'data' => [] ]);
//        }
//    }

}
