<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($username)
    {
        $user = User::where('username','=',$username)->first();
        return view('backend.users.profile',[
            'user'=>$user,
        ]);
    }

    public function allusers()
    {
        // $user = User::all();
        return view('backend.users.userslist');
    }

    public function autoallusers()
    {
        $userData = User::where('id','!=', Auth::user()->id)->get();
        return $userData;
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
            'email' =>'required|email|unique:users,email',
            'password' =>'required',
            // 'confirm_password' => 'required_with:password|same:password',
            'role' =>'required',
        ]);

        $userID = User::insertGetId([
            'name' => $request->name,
            'username' => Str::slug($request->name).'-'.rand(101,999),
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        if($request->hasFile('picture'))
            {
                $image = $request->file('picture');
                $filename = Str::slug($request->name). '-'.Str::slug($request->phone). '.' . $image->getClientOriginalExtension();
                $path = base_path('uploads/users/' . $filename);
                Image::make($image)->fit(1000, 1000)->save($path);

                User::find($userID)->update([
                    'avatar'=>$filename,
                ]);
        }
        return response()->json([
            'success'=>'success'
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
        $user =  User::where('id', $request->id)->first();
        $user->update(['bio'=>$request->user_bio]);


        // picture
        if($request->hasFile('picture'))
        {
            $img_path = base_path('uploads/users/'.$user->avatar);
            if(File::exists($img_path)) {
                File::delete($img_path);
            }

            $image = $request->file('picture');
            $filename = $user->username.'-'.rand(101,200).'.' . $image->getClientOriginalExtension();
            $path = base_path('uploads/users/' . $filename);
            Image::make($image)->fit(1000, 1000)->save($path);
            User::where('id', $request->id)->update([
                'avatar'=>$filename,
            ]);
        }

        return response()->json([
            'success' => 'success',
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
        $user = User::where('id', $request->id)->first();

        $img_path = base_path('uploads/users/'.$user->avater);
        if(File::exists($img_path)) {
            File::delete($img_path);
        }
        $user->delete();
        return response()->json(['success' => 'success',]);
    }

    public function autoauth(){
        $user = User::where('id', Auth::user()->id)->first();
        if ($user->avatar != '') {
            return response()->json([
                'src'=> $user->avatar
            ]);
        } else {
            return response()->json([
                'src'=> 'default.png'
            ]);
        }

    }
}
