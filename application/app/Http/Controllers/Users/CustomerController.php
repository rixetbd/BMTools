<?php

namespace App\Http\Controllers\Users;

use App\Models\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.customers.index');
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
            'name' => 'required',
            'email' =>'required',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
        ]);


        if(empty($request->id)){

            $newID = Customer::insertGetId([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'shopname' => $request->shopname,
                'account_holder' => $request->account_holder,
                'account_number' => $request->account_number,
                'bank_name' => $request->bank_name,
                'bank_branch' => $request->bank_branch,
                'address' => $request->address,
                'city' => $request->city,
                'created_at' => Carbon::now()
            ]);

            if($request->hasFile('picture'))
            {
                $image = $request->file('picture');
                $filename = Str::slug($request->name). '-'.Str::slug($request->phone). '.' . $image->getClientOriginalExtension();
                $path = base_path('uploads/customers/' . $filename);
                Image::make($image)->fit(1000, 1000)->save($path);

                Customer::find($newID)->update([
                    'picture'=>$filename,
                ]);
            }

        }else{
            $customers = Customer::where('id', $request->id)->first();
            $customers->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'shopname' => $request->shopname,
                'account_holder' => $request->account_holder,
                'account_number' => $request->account_number,
                'bank_name' => $request->bank_name,
                'bank_branch' => $request->bank_branch,
                'address' => $request->address,
                'city' => $request->city,
            ]);

            if($request->hasFile('picture'))
            {
                $img_path = base_path('uploads/customers/'.$customers->picture);
                if(File::exists($img_path)) {
                    File::delete($img_path);
                }

                $image = $request->file('picture');
                $filename = Str::slug($request->name). '-'.Str::slug($request->phone). '.' . $image->getClientOriginalExtension();
                $path = base_path('uploads/customers/' . $filename);
                Image::make($image)->fit(1000, 1000)->save($path);

                $customers->update(['picture'=>$filename]);
            }
        }

        return response()->json([
            'success' => 'success',
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
    public function edit(Request $request)
    {
        $customers = Customer::where('id', $request->id)->first();
        return response()->json(['customers' => $customers]);
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
        $customers = Customer::where('id', $request->id)->first();

        $img_path = base_path('uploads/customers/'.$customers->picture);
        if(File::exists($img_path)) {
            File::delete($img_path);
        }
        $customers->delete();
        return response()->json(['success' => 'success',]);
    }

    public function autocustomers()
    {
        $data = Customer::all();
        return $data;
    }
}
