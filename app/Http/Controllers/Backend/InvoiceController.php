<?php
namespace App\Http\Controllers\Backend;
use App\Models\Unit;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Supplier;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use App\Models\InvoiceDetail;
use App\Models\PaymentDetail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
class InvoiceController extends Controller
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
        $data['title'] = "Bill";
        //$data['invoices'] = Invoice::orderBy('date', 'desc')->orderBy('id', 'desc')->where('status', '1')->get();
        $data['invoices'] = Invoice::orderBy('date', 'desc')->orderBy('id', 'desc')->get();
        //dd($data['invoices']);
        return view('backend.pages.invoice.index', $data);
    }
    public function invoice_print()
    {
        $data['title'] = "invoice_print";
        return view('backend.pages.invoice.invoice_print');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
        $data['title'] = "Create Bill";
        $data['units'] = Unit::all();
        $data['products'] = Product::all();
        $data['customers'] = Customer::all();
        $invoice_data = Invoice::orderBy('id', 'desc')->first();
        if ($invoice_data == null) {
            $firstReg = '2020';
            $data['invoice_no'] = $firstReg + 1;
        } else {
            $invoice_data = Invoice::orderBy('id', 'desc')->first()->invoice_no;
            $data['invoice_no'] = $invoice_data + 1;
        }
        return view('backend.pages.invoice.create', $data);;
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
            toast('Sorry you do not added any product !!', 'error');
            return redirect()->back();
        } else {
            if ($request->paid_amount > $request->estimated_amount) {
                toast('Sorry paid amount will not bigger than line total !!', 'error');
                return redirect()->back();
            } else {
                $invoice = new Invoice();
                $invoice->invoice_no = $request->invoice_no;
                $invoice->date = date('Y-m-d', strtotime($request->date));
                $invoice->description = $request->description;
                $invoice->status = '0';
                $invoice->created_by = Auth::user()->id;
                // Transaction start
                DB::transaction(function () use ($request, $invoice) {
                    if ($invoice->save()) {
                        $count_product = count($request->product_id);
                        for ($i = 0; $i < $count_product; $i++) {
                            $invoice_details = new InvoiceDetail();
                            $invoice_details->date = date('Y-m-d', strtotime($request->date));
                            $invoice_details->invoice_id = $invoice->id;
                            $invoice_details->product_id = $request->product_id[$i];
                            $invoice_details->selling_qty = $request->selling_qty[$i];
                            $invoice_details->unt_sell_price = $request->unt_sell_price[$i];
                            $invoice_details->selling_price = $request->selling_price[$i];
                            $invoice_details->status = '1';
                            $invoice_details->save();
                        }
                        #customer
                        if ($request->customer_id == '0') {
                            $customer = new Customer();
                            $customer->name = $request->name;
                            $customer->mobile_no = $request->mobile_no;
                            $customer->address = $request->address;
                            $customer->save();
                            $customer_id = $customer->id;
                        } else {
                            $customer_id = $request->customer_id;
                        }
                        #payment
                        $payment = new Payment();
                        $payment_details = new PaymentDetail();
                        $payment->invoice_id = $invoice->id;
                        $payment->customer_id = $customer_id;
                        $payment->paid_status = $request->paid_status;
                        $payment->discount_amount = $request->discount_amount;
                        $payment->total_amount = $request->estimated_amount;
                        if ($request->paid_status == 'full_paid') {
                            $payment->paid_amount = $request->estimated_amount;
                            $payment->due_amount = '0';
                            $payment_details->current_paid_amount = $request->estimated_amount;
                        } elseif ($request->paid_status == 'full_due') {
                            $payment->paid_amount = '0';
                            $payment->due_amount = $request->estimated_amount;
                            $payment_details->current_paid_amount = '0';
                        } elseif ($request->paid_status == 'partial_paid') {
                            $payment->paid_amount = $request->paid_amount;
                            $payment->due_amount = $request->estimated_amount - $request->paid_amount;
                            $payment_details->current_paid_amount = $request->paid_amount;
                        }
                        $payment->save();
                        $payment_details->invoice_id = $invoice->id;
                        $payment_details->date = date('Y-m-d', strtotime($request->date));
                        $payment_details->save();
                    }
                });

            }
        }
        toast('Invoice has been saved successfully !!', 'success');
        return redirect()->route('invoice.daily.search');
        
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
        if (!is_null($data)) {
            return view('backend.pages.product.edit', $data);
        } else {
            return redirect()->route('backend.pages.product.index');
        }
    }
    public function pendingList()
    {
        $data['title'] = "Pending Invoice";
        $data['invoices'] = Invoice::orderBy('date', 'desc')->orderBy('id', 'desc')->where('status', '0')->get();
        //dd($data['invoices']);
        return view('backend.pages.invoice.pending', $data);
    }
    /**
     * Update the specified resource in storage.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function approve($id)
    {
        $data['title'] = 'Approve Invoice';
        $data['invoice'] = Invoice::with(['invoice_details'])->find($id);
        return view('backend.pages.invoice.approve', $data);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function postDelete($id)
    {
        $delete_row = Invoice::find($id);
        #dd($delete_row);
        if (!is_null($delete_row)) {
            $delete_row->delete();
            InvoiceDetail::where('invoice_id', $delete_row->id)->delete();
            Payment::where('invoice_id', $delete_row->id)->delete();
            PaymentDetail::where('invoice_id', $delete_row->id)->delete();
        }
        toast('Data deleted successfully !!', 'success');
        return back();
    }
    public function appprovalStore(Request $request, $id)
    {
        foreach ($request->selling_qty as $key => $val) {
            $invoice_details = InvoiceDetail::where('id', $key)->first();
            $product = Product::where('id', $invoice_details->product_id)->first();
            //dd($product);
            if ($product->quantity < $request->selling_qty[$key]) {
                toast('Sorry ! you approve maximum value', 'error');
                return redirect()->back();
            }
        }
        $invoice = Invoice::find($id);
        $invoice->approved_by = Auth::user()->id;
        $invoice->status = '1';
        DB::transaction(function () use ($request, $invoice, $id) {
            foreach ($request->selling_qty as $key => $val) {
                $invoice_details            = InvoiceDetail::where('id', $key)->first();
                $invoice_details->status    = '1';
                $invoice_details->save();
                $product           = Product::where('id', $invoice_details->product_id)->first();
                $product->quantity = ((float)$product->quantity) - ((float)$request->selling_qty[$key]);
                $product->save();
            }
            $invoice->save();
        });
        toast('Invoice successfully approved !!', 'success');
        return redirect()->route('invoice.view');
    }
    public function invoicePrintList()
    {
        $data['title'] = "Invoice Print";
        $data['invoices'] = Invoice::orderBy('date', 'desc')->orderBy('id', 'desc')->where('status', '1')->get();
        return view('backend.pages.invoice.print-invoices', $data);
    }
    public function invoicePrint($id)
    {
        $data['invoice'] = Invoice::with(['invoice_details'])->find($id);
        $pdf = PDF::loadView('backend.pages._PDF.inv_pdf', $data);
        //$pdf->SetProtection(['copy','print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
    public function invoiceWeb($id)
    {
        $data['invoice'] = Invoice::with(['invoice_details'])->find($id);
        //dd($data['invoice']);
        return view('backend.pages._PDF.invoice_web', $data);
    }
    public function dailyInvoiceSearch()
    {

        $data['title'] = "Daily Invoice";
        $data['invoices'] = Invoice::orderBy('date', 'desc')->orderBy('id', 'desc')->take(5)->get();
        return view('backend.pages.invoice.daily_search', $data);
    }
    public function dailyInvoiceReport(Request $request)
    {
        $data['title'] = "Bill";
        $st_date    = date('Y-m-d', strtotime($request->start_date));
        $end_date   = date('Y-m-d', strtotime($request->end_date));
        $data['start_date'] = date('Y-m-d', strtotime($request->start_date));
        $data['end_date']   = date('Y-m-d', strtotime($request->end_date));
        $data['invoices']   = Invoice::whereBetween('date', [$st_date, $end_date])->where('status', '1')->get();
        return view('backend.pages.invoice.search_result', $data);
    }
}
