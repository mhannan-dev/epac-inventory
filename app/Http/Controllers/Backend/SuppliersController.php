<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SuppliersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $data['title'] = "Supplier";
        $data['all_supplier'] = Supplier::all();
        return view('backend.pages.supplier.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
        $data['title'] = "Create New Supplier";
        return view('backend.pages.supplier.create', $data);
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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|max:255|unique:suppliers',
            'mobile_no' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'address' => 'required',
            'status' => 'required',
        ]);


        $supplier               = new Supplier();
        $supplier->name         = $request->name;
        $supplier->email        = $request->email;
        $supplier->mobile_no    = $request->mobile_no;
        $supplier->address      = $request->address;
        $supplier->status       = $request->status;
        $supplier->created_by   = Auth::user()->id;
        $supplier->save();

        toast('Data added successfully !!','success');
        return redirect()->route('admin.suppliers.view');

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function getEdit($id)

    {
        $data['title'] = "Update Supplier";
        $data['data_list'] = Supplier::find($id);
        //dd($data);
        if (!is_null($data)) {
            return view('backend.pages.supplier.edit', $data);
        }else {
            return redirect()->route('backend.pages.supplier.index');
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
            'address' => 'required', 'status' => 'required',

        ]
        );


        $supplier = Supplier::find($id);
        $supplier->name = $request->name;
        $supplier->email = $request->email;
        $supplier->mobile_no = $request->mobile_no;
        $supplier->address = $request->address;
        $supplier->status = $request->status;
        $supplier->updated_by   = Auth::user()->id;
        $supplier->save();
        toast('Data has been updated successfully !!','success');
        return redirect()->route('admin.suppliers.view');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function postDelete($id)
    {
        $delete_row = Supplier::find($id);
        //dd($delete_row);
        if (!is_null($delete_row)) {
            $delete_row->delete();
        }
        toast('Data deleted successfully !!','success');
        return back();
    }
}
