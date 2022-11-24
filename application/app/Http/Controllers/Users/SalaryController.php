<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Salary;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emp_id = Employee::select('id','name')->get();
        return view('backend.salary.index',[
            'emp_id'=>$emp_id,
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
            'emp_id' => 'required',
            'salary_month' =>'required',
            'paid_amount' => 'required',
        ]);


        if(empty($request->id)){

            Salary::insert([
                'emp_id' => $request->emp_id,
                'salary_month' => $request->salary_month,
                'paid_amount' => $request->paid_amount,
                'bonus' => $request->bonus,
                'created_at' => Carbon::now()
            ]);

        }else{
            $customers = Salary::where('id', $request->id)->first();
            $customers->update([
                'emp_id' => $request->emp_id,
                'salary_month' => $request->salary_month,
                'paid_amount' => $request->paid_amount,
                'bonus' => $request->bonus,
                'created_at' => Carbon::now()
            ]);
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
        $customers = Salary::where('id', $request->id)->first();
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
        $customers = Salary::where('id', $request->id)->first();

        $img_path = base_path('uploads/customers/'.$customers->picture);
        if(File::exists($img_path)) {
            File::delete($img_path);
        }
        $customers->delete();
        return response()->json(['success' => 'success',]);
    }

    public function autosalaries()
    {

        $salary = Salary::all();
        $data = [];
        foreach($salary as $key=>$value){
            $data[] = [
                'id'=>$value->id,
                'name'=>$value->getEmpName->name,
                'salary'=>$value->getEmpName->salary,
                'salary_month'=>$value->salary_month,
                'paid_amount'=>$value->paid_amount,
                'bonus'=>$value->bonus,
            ];
        }
        return $data;
    }
}
