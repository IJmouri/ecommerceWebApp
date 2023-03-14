<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;
use Illuminate\Support\Str;

class ChildCategoryController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){

        if($request->ajax()){
            $data = DB::table('childcategories')
            ->leftJoin('categories','childcategories.category_id','categories.id')
            ->leftJoin('subcategories','childcategories.subcategory_id','subcategories.id')
            ->select('categories.category_name','subcategories.subcategory_name','childcategories.*')
            ->get();

            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action',function($row){
                        $actionbtn = '<a href="#" class="btn btn-info btn-sm edit" data-id="'.$row->id .'" data-toggle="modal" data-target="#categoryEditModal"><i class="fas fa-edit"></i></a>
                        <a href="' .route('childcategory.delete',[ $row -> id ]) .'" class="btn btn-danger btn-sm" id="delete"><i class="fas fa-trash"></i></a>';
                        
                        return $actionbtn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);

        }

        $category = DB::table('categories')->get();

        return view('admin.category.childcategory.index',compact('category'));

    }

    public function store(Request $request){

        $cat = DB::table('subcategories')->where('id',$request->subcategory_id)->first();

        $data = array();
        $data['category_id'] = $cat->category_id;
        $data['subcategory_id'] = $request->subcategory_id; 
        $data['childcategory_name'] = $request->childcategory_name; 
        $data['childcategory_slug'] = Str::slug($request->childcategory_name,'-'); 
        
        DB::table('childcategories')->insert($data);

        $alertmsg = array('message' => 'Child Category Inserted', 'alert-type' => 'success');
        return redirect()->back()->with($alertmsg);
    
       
    }

    public function delete($id)
    {
        //query builder
        DB::table('childcategories')->where('id', $id)->delete();

        $alertmsg = array('message' => 'Child-Category Deleted!', 'alert-type' => 'success');
        return redirect()->back()->with($alertmsg);
    }

    public function edit($id)
    {
        $data = DB::table('childcategories')->where('id',$id)->first();
        $category = DB::table('categories')->get();

        return view('admin.category.childcategory.edit', compact('data', 'category'));
    }

    public function update(Request $request)
    {
        // query builder
        $cat = DB::table('subcategories')->where('id',$request->subcategory_id)->first();

        $data = array();
        $data['category_id'] = $cat->category_id;
        $data['subcategory_id'] = $request->subcategory_id; 
        $data['childcategory_name'] = $request->childcategory_name; 
        $data['childcategory_slug'] = Str::slug($request->childcategory_name,'-'); 
        
        // dd($data);
        DB::table('childcategories')->where('id',$request->childcategory_id)->update($data);


        $alertmsg = array('message' => 'Childcategory Updated!', 'alert-type' => 'success');
        return redirect()->back()->with($alertmsg);
    }

}
