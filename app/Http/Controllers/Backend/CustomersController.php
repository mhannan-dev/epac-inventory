<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CustomersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $data['title'] = "Customer";
        $data['all_supplier'] = Customer::all();
        return view('backend.pages.customer.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
        $data['title'] = "Create New Customer";
        return view('backend.pages.customer.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function postStore(Request $request)
    {
        //dd($request);
        $request->validate([

            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:customers',
            'mobile_no' => 'required|regex:/(01)[0-9]{9}/',
            'address' => 'required',

        ],
            [
                'name.required' => 'Please enter a name',
                'email' => 'Please enter a email',
                'mobile_no' => 'Please enter mobile no',
                'address' => 'Enter password address',
            ]
        );

        $customer               = new  Customer();
        $customer->name         = $request->name;
        $customer->email        = $request->email;
        $customer->mobile_no    = $request->mobile_no;
        $customer->address      = $request->address;
        $customer->created_by   = Auth::user()->id;
        $customer->save();
        toast('Data added successfully !!','success');
        return redirect()->route('admin.customers.view');

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function getEdit($id)

    {
        $data['title'] = "Update Customer";
        $data['data_list'] = Customer::find($id);
        //dd($data);
        if (!is_null($data)) {
            return view('backend.pages.customer.edit', $data);
        }else {
            return redirect()->route('backend.pages.customer.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function postUpdate(Request $request, $id)
    {
        //dd($request);
        $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required',
                'mobile_no' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                'address' => 'required',
            ]
        );


        $customer = Customer::find($id);
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->mobile_no = $request->mobile_no;
        $customer->address = $request->address;
        $customer->updated_by   = Auth::user()->id;
        $customer->save();
        toast('Data has been updated successfully !!','success');
        return redirect()->route('admin.customers.view');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function postDelete($id)
    {
        $delete_row = Customer::find($id);
        //dd($delete_row);
        if (!is_null($delete_row)) {
            $delete_row->delete();
        }
        toast('Data deleted successfully !!','success');
        return back();
    }
}
