<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // $data = DB::table('categories')->get(); // query builder
        $data = Category::all(); // eloquent ORM
        return view('admin.category.category.index',compact('data'));
        // return response()->json($data);
    }

    public function store(Request $request){
        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:100',
           
        ]);

        //query builder
        // $data = array();
        // $data['category_name'] = $request->category_name;
        // $data['category_slug'] = Str::slug($request->category_name, '-');

        // DB::table('categories')->insert($data);

        // Eloquent ORM
        Category::insert([
            'category_name'=>$request->category_name,
            'category_slug'=>Str::slug($request->category_name, '-'),
        ]);

        $alertmsg = array('message' => 'Category Inserted','alert-type'=> 'success');
        return redirect()->back()->with($alertmsg);
    }

    public function delete($id)
    {
        //query builder
        DB::table('categories')->where('id',$id)->delete();
        
        $alertmsg = array('message' => 'Category Deleted!','alert-type'=> 'success');
        return redirect()->back()->with($alertmsg);
    }

    public function edit($id)
    {
        // $data = DB::table('categories')->where('id',$id)->first();
        $data = Category::findorfail($id);

        return response()->json($data);

    }

    public function update(Request $request)
    {
    
        // query builder

        // $data=array();
        // $data['category_name'] = $request->category_name;
        // $data['category_slug'] = Str::slug($request->category_name,'-');

        // DB::table('categories')->where('id',$request->category_id)->update($data);
        
        // eloquent ORM
        $category = Category::where('id',$request->category_id)->first();

        $category -> update([
            'category_name'=>$request->category_name,
            'category_slug'=>Str::slug($request->category_name, '-'),
        ]);
        $alertmsg = array('message' => 'Category Updated!','alert-type'=> 'success');
        return redirect()->back()->with($alertmsg);

    }

}
