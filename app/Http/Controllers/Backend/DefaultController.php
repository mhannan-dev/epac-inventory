<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\Product;
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

    public function getSupplier(Request $request){
        $r_brand_id = $request->brand_id;
        //dd($r_brand_id);
        $allSupplier = Product::with('prd_supplier')->select('supplier_id')->where('brand_id',$r_brand_id)->groupBy('supplier_id')->get();
        //dd($allSupplier);
        return response()->json($allSupplier);
    }


    public function getCategory(Request $request)
    {
        $r_supplier_id = $request->supplier_id;
        $allCategory = Product::with('category')->select('category_id')->where('supplier_id',$r_supplier_id)->groupBy('category_id')->get();
        return response()->json($allCategory);
    }

    public function categoryForInvoice(Request $request)
    {
        $r_brand_id = $request->brand_id;
        $allCategory = Product::with('category')->select('category_id')->where('brand_id',$r_brand_id)->groupBy('category_id')->get();
        //dd($allCategory);
        return response()->json($allCategory);
    }


    public function getProducts(Request $request){
        $r_category_id = $request->category_id;
        $allProducts = Product::where('category_id',$r_category_id)->get();
        #dd($allProducts);
        return response()->json($allProducts);
    }

    public function getUnits(Request $request){
        $r_product_id = $request->product_id;
       // dd($r_product_id);
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
