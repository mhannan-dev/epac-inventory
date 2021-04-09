<?php

namespace App\Http\Controllers\Backend;

use App\Models\Unit;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
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

     $data['products'] = Product::orderBy('supplier_id' ,'ASC')->orderBy('category_id' ,'ASC')->get();
     return view('backend.pages._PDF.stock_report', $data);
     //$pdf = PDF::loadView('backend.pages._PDF.stock_report', $data);
     //$pdf->SetProtection(['copy','print'], '', 'pass');
     //return $pdf->stream('stock_report.pdf');

    }


}
