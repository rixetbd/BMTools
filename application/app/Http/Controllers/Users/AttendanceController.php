<?php

namespace App\Http\Controllers\Users;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.attendance.attendance');
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
        Attendance::insert([
            'emp_id'=>Auth::user()->id,
            'att_date'=>Carbon::now()->format('d-M'),
            'att_year'=>Carbon::now()->format('Y'),
            'status'=>$request->status,
            'created_at'=>Carbon::now(),
        ]);
        return back();
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
        Attendance::findOrFail($request->id)->delete();
        return response()->json(['success' => 'success',]);
    }


    public function autoattendances()
    {
        $attendance = Attendance::all();
        foreach($attendance as $key=>$value){
            $data[] = [
                'id'=>$value->id,
                'emp_id'=>$value->getEmpName->name,
                'att_date'=>$value->att_date,
                'att_year'=>$value->att_year,
                'time'=>$value->created_at->format('h:i:s'),
                'status'=>$value->status,
            ];
        }
        return $data;
    }


}
