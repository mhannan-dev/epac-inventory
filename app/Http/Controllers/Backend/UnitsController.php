<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UnitsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $data['title'] = "Product Units";
        $data['all_supplier'] = Unit::all();
        return view('backend.pages.units.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
        $data['title'] = "Create New Unit";
        $data['brands'] = Brand::all();
        return view('backend.pages.units.create', $data);
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
                'name' => 'required|string|max:255|unique:categories',
                'status' => 'required',
                ]
        );

        $unit = new  Unit();
        $unit->name = $request->name;
        $unit->status = $request->status;
        //$unit->brand_id = $request->brand_id;
        $unit->created_by = Auth::user()->id;
        $unit->save();

        toast('Data added successfully !!', 'success');
        return redirect()->route('admin.units.view');

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function getEdit($id)

    {
        $data['title'] = "Update Unit";
        $data['data_list'] = Unit::find($id);
        //dd($data);
        if (!is_null($data)) {
            return view('backend.pages.units.edit', $data);
        } else {
            return redirect()->route('backend.pages.units.index');
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
                'status' => 'required',

            ]
        );


        $unit = Unit::find($id);
        $unit->name = $request->name;
        $unit->status = $request->status;
        $unit->updated_by   = Auth::user()->id;
        $unit->save();
        toast('Data has been updated successfully !!','success');
        return redirect()->route('admin.units.view');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function postDelete($id)
    {
        $delete_row = Unit::find($id);
        //dd($delete_row);
        if (!is_null($delete_row)) {
            $delete_row->delete();
        }
        toast('Data deleted successfully !!', 'success');
        return back();
    }
}
