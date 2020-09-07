<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use Illuminate\Http\Request;

use function GuzzleHttp\Promise\all;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.user.index')->with('users',User::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required',
                'email' => 'required|email',
            ]
        );
        $user = User::create(['name'=>$request->name,'email'=>$request->email,'password'=>bcrypt('password')]);

        Profile::create(
            [
                'user_id' => $user->id,
                'avatar' => 'uploads/profile/profile_male_1.png'
            ]
        );

        toastr()->success('Create new user successfully.');

        return redirect()->route('users');
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
    public function edit($user_profile)
    {
        // $user_profile = Profile::find(['user_id'=>$id])->first();
        $user_permission = 'ADMIN';
        if($user_profile->is_admin){
            $user_profile->is_admin = 0;
            $user_permission = 'GENERAL';
        }else{
            $user_profile->is_admin = 1;
        }
        $user_profile->save();
        toastr()->success('Change user permission to ' . $user_permission . ' successfully.');
        return redirect()->back();
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
        $user = User::find($id);

        // $user->profile->delete();

        $user->delete();
        toastr()->success('Delete profile successfully');
        return redirect()->back();
    }
}
