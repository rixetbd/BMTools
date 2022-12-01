<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $settings = Settings::where('status', '1')->first();
        return view('backend.settings.index',[
            'settings'=>$settings,
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
        //
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
        $settings_last = Settings::where('status', '1')->first();
        if ($settings_last) {
            $settings_last->update(['status'=>'0']);
        }

        $settings = Settings::insertGetId([
                'company_name' =>$request->company_name,
                'company_email' =>$request->company_email,
                'company_phone' =>$request->company_phone,
                'company_logo' =>($settings_last != ''?$settings_last->company_logo:''),
                'company_address' =>$request->company_address,
                'company_city' =>$request->company_city,
                'company_country' =>$request->company_country,
                'company_website' =>$request->company_website,
                'created_at' =>Carbon::now(),
        ]);

        if($request->hasFile('company_logo'))
        {
            $image = $request->file('company_logo');
            $filename = Str::slug($request->company_name). '-'.rand(1,9) . '.' . $image->getClientOriginalExtension();
            $path = base_path('uploads/company/' . $filename);
            Image::make($image)->fit(400, 300)->save($path);
            Settings::find($settings)->update([
                'company_logo'=>$filename,
            ]);
        }

        $settings_old = Settings::where('status', '0')->get();
        foreach ($settings_old as $value) {
            $img_path = base_path('uploads/company/'.$value->company_logo);
            if(File::exists($img_path)) {
                File::delete($img_path);
            }
        }
        Settings::where('status', '0')->delete();

        return response()->json([
            'success'=>'success'
        ]);
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

    public function autoSettings()
    {
        $settings = Settings::where('status', '1')->first();
        return $settings;
    }
}
