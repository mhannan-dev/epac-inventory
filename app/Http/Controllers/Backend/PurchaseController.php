<?php

namespace App\Http\Controllers\Backend;

use App\Models\Unit;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{

    
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $data['title'] = "Product";
        $data['products'] = Purchase::orderBy('date', 'desc')->orderBy('id', 'desc')->get();
        //dd($data['products']);
        return view('backend.pages.purchase.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
        $data['title'] = "Store From";
        $data['suppliers'] = Supplier::all();
        $data['units'] = Unit::all();
        $data['products'] = Product::all();
        //dd($data);
        return view('backend.pages.purchase.create', $data);;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function postStore(Request $request)
    {
        //dd($request->all());

        if ($request->product_id == null) {
            toast('Sorry do not dot select any items !!', 'error');
            return redirect()->back();

        } else {
            $count_product = count($request->product_id);
            //dd($count_product);
            for ($i = 0; $i < $count_product; $i++) {
                $pucrhase = new  Purchase();
                $pucrhase->date = date('Y-m-d', strtotime($request->date[$i]));
                $pucrhase->supplier_id = $request->supplier_id[$i];
                $pucrhase->product_id = $request->product_id[$i];
                $pucrhase->description = $request->description[$i];
                $pucrhase->unit_id = $request->unit_id[$i];
                $pucrhase->buying_qty = $request->buying_qty[$i];
                $pucrhase->unit_price = $request->unit_price[$i];
                $pucrhase->unt_sell_price = $request->unt_sell_price[$i];
                $pucrhase->buying_price = $request->buying_price[$i];
                $pucrhase->created_by = Auth::user()->id;
                $pucrhase->status = '0';
                $pucrhase->save();
            }
        }
        toast('Data added successfully !!', 'success');
        return redirect()->route('purchase.pending.list');

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function getEdit($id)

    {
        $data['title'] = "Update Product";
        $data['suppliers'] = Supplier::all();
        $data['units'] = Unit::all();
        $data['product'] = Product::find($id);
        //dd($data['product']);
        if (!is_null($data)) {
            return view('backend.pages.product.edit', $data);
        } else {
            return redirect()->route('backend.pages.product.index');
        }
    }

    public function pendingList()
    {
        $data['title'] = "Pending Product";
        $data['purchases'] = Purchase::orderBy('date', 'desc')->orderBy('id', 'desc')->where('status', '0' )->get();
        //dd($data['purchase']);
        return view('backend.pages.purchase.pending', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function purchaseApprove($id)
    {
        $purchase = Purchase::find($id);

        $product = Product::where('id', $purchase->product_id )->first();
        //dd($product);
        $purchase_qty = ((DOUBLE)($purchase->buying_qty))+((DOUBLE)($product->quantity));
        $product->quantity = $purchase_qty;

        if($product->save()){
            DB::table('purchases')->where('id',$id)->update(['status'=> 1]);
        }

        toast('Data has been approved successfully !!', 'success');
        return redirect()->route('purchase.pending.list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function postDelete($id)
    {

        $delete_row = Purchase::find($id);
        //dd($delete_row);
        if (!is_null($delete_row)) {
            $delete_row->delete();
        }
        toast('Data deleted successfully !!', 'success');
        return back();
    }
}
