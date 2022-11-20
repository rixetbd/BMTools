<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Flasher\Notyf\Prime\NotyfFactory;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.products.category');
    }

    public function sub_categories()
    {
        $category = Category::all();
        return view('backend.products.subcategory',[
            'category'=>$category,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|unique:categories,name',
        ]);
        Category::insert([
            'name'=>$request->name,
            'slug'=>Str::slug($request->name),
            'created_at'=>Carbon::now(),
        ]);
        return response()->json([
            'success'=>'success',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'name'=>'required|unique:categories,name',
        ]);
        Category::find($request->id)->update([
            'name'=>$request->name,
            'slug'=>Str::slug($request->name),
        ]);
        return response()->json([
            'success'=>'success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Category::where('id', $request->id)->delete();
        return response()->json([
            'success'=>'success',
        ]);
    }


    public function autocategories()
    {
        $data = Category::all();
        return response()->json([
            'data'=>$data,
        ]);
    }
    public function autosubcategories()
    {
        $subcategory = SubCategory::all();
        $data = "";
        foreach($subcategory as $key=>$value){
            $data .= '<tr><td>'.($key+1).'</td><td>'.$value->name.'</td><td>'.$value->slug.'</td><td>'.($value->getCategoryName->name != ""?$value->getCategoryName->name : 'N/A').'</td><td class="text-center"><button class="border-0 btn-sm btn-info me-2" onclick="cat_edit(\''.$value->id.'\', \''.$value->name.'\',\''.$value->getCategoryName->id.'\')"><i class="fa fa-edit"></i></button><button class="border-0 btn-sm btn-danger" onclick="cat_distroy('.$value->id.')"><i class="fa fa-trash"></i></button></td></tr>';
        }
        return response()->json([
            'data'=>$data,
        ]);
    }


    public function sub_store(Request $request)
    {
        $request->validate([
            'category_id'=>'required',
            'name'=>'required|unique:sub_categories,name',
        ]);
        SubCategory::insert([
            'category_id'=>$request->category_id,
            'name'=>$request->name,
            'slug'=>Str::slug($request->name),
            'created_at'=>Carbon::now(),
        ]);
        return response()->json([
            'success'=>'success',
        ]);
    }
    public function sub_destroy(Request $request)
    {
        SubCategory::where('id', $request->id)->delete();
        return response()->json([
            'success'=>'success',
        ]);
    }

}
