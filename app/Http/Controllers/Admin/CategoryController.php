<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use DB;

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

}
