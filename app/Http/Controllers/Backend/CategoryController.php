<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class CategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $data['title'] = "Product Category";
        $data['all_supplier'] = Category::all();
        return view('backend.pages.category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
        $data['title'] = "Create New Category";
        return view('backend.pages.category.create', $data);
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
                'status' => 'required',]
        );

        $category = new  Category();
        $category->name = $request->name;
        $category->code = Str::slug($request->name);
        $category->status = $request->status;
        $category->created_by = Auth::user()->id;
        $category->save();

        toast('Data added successfully !!', 'success');
        return redirect()->route('admin.category.view');

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function getEdit($id)

    {
        $data['title'] = "Update Category";
        $data['data_list'] = Category::find($id);
        //dd($data);
        if (!is_null($data)) {
            return view('backend.pages.category.edit', $data);
        } else {
            return redirect()->route('backend.pages.category.index');
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


            ]
        );


        $supplier = Category::find($id);
        $supplier->name = $request->name;
        $supplier->code = Str::slug($request->name);
        $supplier->status = $request->status;
        $supplier->updated_by   = Auth::user()->id;
        $supplier->save();
        toast('Data has been updated successfully !!','success');
        return redirect()->route('admin.category.view');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function postDelete($id)
    {
        $delete_row = Category::find($id);
        //dd($delete_row);
        if (!is_null($delete_row)) {
            $delete_row->delete();
        }
        toast('Data deleted successfully !!', 'success');
        return back();
    }
}
