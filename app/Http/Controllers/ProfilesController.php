<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDO;

class ProfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.user.profile')->with('user',Auth::user());
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
        // dd($request->all());

        // dd($request->tags);
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email',
            'facebook' => 'required|url',
            'gmail' => 'required|url',
            'about' => 'required'
        ]);
        
        $u_user = User::find(Auth::user()->id);
          
        if($request->hasFile('avatar')){
            
            $avatar = $request->avatar;
            
            $avatar_new_name = time() . $avatar->getClientOriginalName();
            
            $avatar->move('uploads/posts',$avatar_new_name);

            $u_user->profile->avatar = 'uploads/posts/' . $avatar_new_name;

        }

        $u_user->name = $request->name;
        $u_user->email = $request->email;
        $u_user->profile->facebook = $request->facebook;
        $u_user->profile->gmail = $request->gmail;
        $u_user->profile->about = $request->about;
        $u_user->profile->gmail = $request->gmail;
        
        if($request->has('password')){
            $u_user->password = bcrypt($request->password);
        }

        $u_user->save();
        $u_user->profile->save();
        toastr()->success('Update profile successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $user = User::find($id);

        // $user->profile->delete();

        // $user->delete();
        // toastr()->success('Delete profile successfully');
        // return redirect()->back();
    }
}
