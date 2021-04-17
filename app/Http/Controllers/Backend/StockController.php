<?php

namespace App\Http\Controllers\Backend;
use App\Models\Unit;
use App\Models\Product;

use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class StockController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function stockReport()
    {

        $data['title'] = "Stock";
        $data['products'] = Product::orderBy('supplier_id' ,'ASC')->orderBy('id' ,'ASC')->get();
        //dd($data['products']);
        return view('backend.pages.stock.report', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function stockReportPdf()
    {

     $data['products'] = Product::orderBy('supplier_id' ,'ASC')->orderBy('id' ,'ASC')->get();
     return view('backend.pages._PDF.stock_report', $data);
     //$pdf = PDF::loadView('backend.pages._PDF.stock_report', $data);
     //$pdf->SetProtection(['copy','print'], '', 'pass');
     //return $pdf->stream('stock_report.pdf');

    }
    public function stockSupplierWise()
    {
     $data['title'] = "Supplier/Product Wise Stock";
     $data['suppliers'] = Supplier::where('status', 'active')->get();
     $data['products'] = Product::orderBy('supplier_id' ,'ASC')->get();
     return view('backend.pages.stock.supplier-wise', $data);
    }

    public function stockReportSupplierWise(Request $request)
    {
        $data['products'] = Product::orderBy('supplier_id' ,'ASC')->where('supplier_id', $request->supplier_id)->get();
        //dd($data['products']);
        return view('backend.pages.stock.supplier_wise_stock', $data);
    }
    public function supplierWiseStockPrint(Request $request)
    {
        
        $data['supplier_wise_stock'] = Product::orderBy('supplier_id' ,'ASC')->where('supplier_id', $request->supplier_id)->get();
        return view('backend.pages._PDF.supplier_wise_st_print', $data);
    }


}
