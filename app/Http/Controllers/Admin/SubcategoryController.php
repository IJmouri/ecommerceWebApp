<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Str;

class SubcategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // QUERY BUILDER
        // $data = DB::table('subcategories')->leftjoin('categories', 'subcategories.category_id', 'categories.id')
        //     ->select('subcategories.*', 'categories.category_name')->get();

        // ELOQUENT ORM
        $data = Subcategory::all();
        $category = Category::all();  // join subcategory and category table via model

        return view('admin.category.subcategory.index', compact('data', 'category'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subcategory_name' => 'required|max:100',

        ]);

        //query builder
        // $data = array();
        // $data['category_id'] = $request->category_id;
        // $data['subcategory_name'] = $request->subcategory_name;
        // $data['subcategory_slug'] = Str::slug($request->subcategory_name, '-');

        // DB::table('subcategories')->insert($data);

        // Eloquent ORM
        Subcategory::insert([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'subcategory_slug' => Str::slug($request->subcategory_name, '-'),
        ]);

        $alertmsg = array('message' => 'Sub Category Inserted', 'alert-type' => 'success');
        return redirect()->back()->with($alertmsg);
    }

    public function delete($id)
    {
        //query builder
        DB::table('subcategories')->where('id', $id)->delete();

        $alertmsg = array('message' => 'Sub-Category Deleted!', 'alert-type' => 'success');
        return redirect()->back()->with($alertmsg);
    }

    public function edit($id)
    {
        $data = Subcategory::find($id);
        $category = DB::table('categories')->get();

        return view('admin.category.subcategory.edit', compact('data', 'category'));
    }

    public function update(Request $request)
    {
        // eloquent ORM
        $subcategory = Subcategory::where('id', $request->subcategory_id)->first();

        $subcategory->update([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'subcategory_slug' => Str::slug($request->subcategory_name, '-'),
        ]);

        $alertmsg = array('message' => 'Subcategory Updated!', 'alert-type' => 'success');
        return redirect()->back()->with($alertmsg);
    }
}
