<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Supplier;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SubCategoryController extends Controller
{
    public function getIndex()
    {
       $data['title'] = "Sub Category";
       $data['sub_category'] = SubCategory::all();

       return view('backend.pages.category-sub.index', $data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
        $data['title'] = "Create Subcategory";
        $data['categories'] = Category::all();
        $data['brands'] = Brand::all();
        //dd($data);
        return view('backend.pages.category-sub.create', $data);;
    }

    public function postStore(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'category_id' => 'required',
            'brand_id' => 'required',
            'name' => 'required|string|max:255',
        ],
            [
                'category_id.required' => 'Please select category',
                'brand_id.required' => 'Please select brand',
                'name.required' => 'Please enter a name',
            ]
        );

        $product = new  SubCategory();
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->name = $request->name;
        $product->slug = $request->name;
        $product->created_by = Auth::user()->id;
        $product->save();
        toast('Data added successfully !!', 'success');
        return redirect()->route('admin.sub_category.view');

    }

    public function getEdit($id)

    {
        $data['title'] = "Update Product";
        $data['suppliers'] = Supplier::all();
        $data['categories'] = Category::all();
        $data['brands'] = Brand::all();
        $data['units'] = Unit::all();
        $data['sub_category'] = SubCategory::find($id);
        //dd($data['product']);
        if (!is_null($data)) {
            return view('backend.pages.category-sub.edit', $data);
        } else {
            return redirect()->route('backend.pages.category-sub.index');
        }
    }
    public function postUpdate(Request $request, $id)
    {
        //dd($request->all());
        $request->validate([
            'category_id' => 'required',
            'brand_id' => 'required',
            'name' => 'required|string|max:255',
        ],
            [
                'category_id.required' => 'Please select category',
                'brand_id.required' => 'Please select brand',
                'name.required' => 'Please enter a name',
            ]
        );

        $product = SubCategory::find($id);
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->name = $request->name;
        $product->slug = $request->name;
        $product->updated_by = Auth::user()->id;
        $product->update();
        toast('Data has been updated successfully !!', 'success');
        return redirect()->route('admin.sub_category.view');
    }

    public function postDelete($id)
    {

        $delete_row = SubCategory::find($id);
       // dd($delete_row);
        if (!is_null($delete_row)) {
            $delete_row->delete();
        }
        toast('Data deleted successfully !!', 'success');
        return back();
    }
}
