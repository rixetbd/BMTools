<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.products.products');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        return view('backend.products.create',[
            'category'=>$category,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->picture->getClientOriginalName();
        $newID = Product::insertGetId([
            'category_id'=>$request->category_id,
            'subcategory_id'=>$request->subcategory_id,
            'title'=>$request->title,
            'slug'=>Str::slug($request->title),
            'price'=>$request->price,
            'quantity'=>$request->quantity,
            'description'=>$request->description,
            'author'=>Auth::user()->name,
            'created_at'=>Carbon::now(),
        ]);

        if($request->hasFile('picture'))
        {
            $image = $request->file('picture');
            $filename = Str::slug($request->title). '-'.time() . '.' . $image->getClientOriginalExtension();
            $path = base_path('upload/products/' . $filename);
            Image::make($image)->fit(400, 300)->save($path);

            Product::find($newID)->update([
                'picture'=>$filename,
            ]);
        }

        return response()->json([
            'data'=>$request->picture->getClientOriginalName(),
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function autoproducts()
    {
        $product = Product::all();
        foreach($product as $key=>$value){
            $data[] = [
                'id'=>$value->id,
                'category_id'=>$value->getCategoryName->id,
                'category_name'=>$value->getCategoryName->name,
                'subcategory_id'=>$value->getSubCategoryName->id,
                'subcategory_name'=>$value->getSubCategoryName->name,
                'title'=>$value->title,
                'slug'=>$value->slug,
                'price'=>$value->price,
                'quantity'=>$value->quantity,
                'picture'=>$value->picture,
                'status'=>$value->status,
            ];
        }
        return $data;
    }



}
