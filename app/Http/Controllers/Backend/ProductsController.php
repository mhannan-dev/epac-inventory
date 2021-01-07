<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Customer;
use App\Models\SubCategory;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProductsController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $data['title'] = "Product";
        $data['products'] = Product::all();
        //dd($data['products']);
        return view('backend.pages.product.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
        $data['title'] = "Create New Product";
        $data['suppliers'] = Supplier::all();
        $data['categories'] = Category::all();
        $data['units'] = Unit::all();
        return view('backend.pages.product.create', $data);;
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
            'supplier_id' => 'required',
            'category_id' => 'required',
            //'unit_id' => 'required',
            'name' => 'required|string|max:255',
        ],
            [
                'category_id.required' => 'Please select category',
                'supplier_id.required' => 'Please select supplier',
                //'unit_id.required' => 'Please select unit',
                'name.required' => 'Please enter a name',
            ]
        );

        $product = new  Product();
        $product->supplier_id = $request->supplier_id;
        $product->category_id = $request->category_id;
        //$product->unit_id = $request->unit_id;
        $product->name = $request->name;
        $product->created_by = Auth::user()->id;
        $product->save();
        toast('Data added successfully !!', 'success');
        return redirect()->route('admin.products.view');

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
        $data['categories'] = Category::all();
        $data['units'] = Unit::all();
        $data['product'] = Product::find($id);
        if (!is_null($data)) {
            return view('backend.pages.product.edit', $data);
        } else {
            return redirect()->route('backend.pages.product.index');
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
        //dd($request->all());
        $request->validate([
                'category_id' => 'required',
                'supplier_id' => 'required',
                'name' => 'required|string|max:255',
                //'unit_id' => 'required',
            ]
        );

        $product = Product::find($id);
        $product->supplier_id = $request->supplier_id;
        $product->category_id = $request->category_id;
        //$product->unit_id = $request->unit_id;
        $product->name = $request->name;
        $product->updated_by = Auth::user()->id;
        $product->save();

        toast('Data has been updated successfully !!', 'success');
        return redirect()->route('admin.products.view');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function postDelete($id)
    {

        $delete_row = Product::find($id);
        // dd($delete_row);
        if (!is_null($delete_row)) {
            $delete_row->delete();
        }
        toast('Data deleted successfully !!', 'success');
        return back();
    }
}
