<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\token_resource;
use App\Http\Resources\users_comments_resources;
use App\Http\Resources\users_posts_resources;
use App\Http\Resources\users_resources;
use App\Http\Resources\usersID_resource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class users_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return new users_resources($users);
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
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));
        $user->save();

        return new users_resources([$user]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $id)
    {
        return new usersID_resource($id);
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
        $user = User::find($id);
        // 
        if ($request->has('name')) {
            $user->name = $request->get('name');
        }
        $user->save();
        return new users_resources([$user]);
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


    public function auther_post($id)
    {
        $user = User::find($id);
        $post = $user->posts()->paginate();
        return new users_posts_resources($post);
    }

    public function auther_comments($id)
    {
        $user = User::find($id);
        $com = $user->comment;
        return new users_comments_resources($com);
    }

    public function get_token(Request $request)
    {

        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        $credential = $request->only('email', 'password');
        if (Auth::attempt($credential)) {
            $user = User::where('email', $request->get('email'))->first();
            return new token_resource(['token' => $user->api_token]);
        } else {
            return 'not found';
        }
    }
}
