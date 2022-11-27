<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
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
        $supplier = Supplier::all();

        return view('backend.products.create',[
            'category'=>$category,
            'supplier'=>$supplier,
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
            'supplier_id'=>$request->supplier_id,
            'product_code'=>$request->product_code,
            'buy_date'=>$request->buy_date,
            'buying_price'=>$request->buying_price,
            'selling_price'=>$request->selling_price,
            'quantity'=>$request->quantity,
            'description'=>$request->description,
            'created_at'=>Carbon::now(),
        ]);


        if($request->hasFile('picture'))
        {
            $image = $request->file('picture');
            $filename = Str::slug($request->title). '-'.time() . '.' . $image->getClientOriginalExtension();
            $path = base_path('uploads/products/' . $filename);
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
    public function destroy(Request $request)
    {
        $product = Product::where('id', $request->id)->first();
        $img_path = base_path('uploads/products/'.$product->picture);
        if(File::exists($img_path)) {
            File::delete($img_path);
        }
        $product->delete();
        return response()->json(['success' => 'success',]);
    }

    public function autoproducts()
    {
        $product = Product::all();
        $data = [];
        foreach($product as $key=>$value){
            $data[] = [
                'id'=>$value->id,
                'category_id'=>$value->getCategoryName->id,
                'category_name'=>$value->getCategoryName->name,
                'subcategory_id'=>$value->getSubCategoryName->id,
                'subcategory_name'=>$value->getSubCategoryName->name,
                'title'=>$value->title,
                'slug'=>$value->slug,
                'buying_price'=>$value->buying_price,
                'selling_price'=>$value->selling_price,
                'quantity'=>$value->quantity,
                'picture'=>$value->picture,
                'status'=>$value->status,
            ];
        }
        return $data;
    }



}
