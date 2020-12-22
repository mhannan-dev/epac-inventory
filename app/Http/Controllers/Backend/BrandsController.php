<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Validator;


class BrandsController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getIndex()
    {
        $data['title'] = "Brand";
        $data['all_brands'] = Brand::all();
        //dd($data);
        return view('backend.pages.brand.index', $data);
    }

    public function getCreate()
    {
        $data['title'] = "Create New Brand";
        return view('backend.pages.brand.create', $data);
    }

    public function postStore(Request $request)
    {
        //return $request->all();

        $request->validate([
            'name' => 'required|string|max:100|unique:brands',
        ]);

        $brand = new Brand();
        $brand->name = $request->name;
        $brand->code = Str::slug($request->name);
        $brand->description = $request->description;
        $brand->status = $request->status;
        $brand->created_by = Auth::user()->id;
        $brand->save();

        //dd($brand);
        toast('Data saved successfully !!', 'success');
        return redirect()->route('admin.brand.view');

    }

    public function postDelete($id)
    {
        $delete_row = Brand::find($id);
        //dd($delete_row);
        if (!is_null($delete_row)) {
            $delete_row->delete();
        }

        toast('Data has deleted successfully !!', 'success');
        return back();
    }


    public function getEdit($id)

    {
        $data['title'] = "Update Brand";
        $data['data_list'] = Brand::find($id);
        //dd($data);
        if (!is_null($data)) {
            return view('backend.pages.brand.edit', $data);
        } else {
            return redirect()->route('backend.pages.brand.index');
        }
    }

    public function postUpdate(Request $request, $id)
    {
        //dd($request);
        $request->validate([
                'name' => 'required|string|max:255',
                'code' => 'required',
            ]
        );

        $brand = Brand::find($id);
        $brand->name = $request->name;
        $brand->code = $request->code;
        $brand->status = $request->status;
        $brand->updated_by = Auth::user()->id;
        $brand->save();
        //dd($brand);
        toast('Data has been updated successfully !!', 'success');
        return redirect()->route('admin.brand.view');


    }

}
