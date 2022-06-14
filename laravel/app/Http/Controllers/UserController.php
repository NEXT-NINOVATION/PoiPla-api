<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function register()
    {
        $user = User::create();
        $token = $user->createToken("user_" . $user->id);

        return ["token" => $token->plainTextToken];
    }

    public function me()
    {
        return Auth::user();
    }

    public function update(UpdateUserRequest $request)
    {
        $user = Auth::user();
        $user->name = $request->input("name");
        if ($request->input("costume_id")) {
            $user->costume_id = $request->input("costume_id");
        }
        $user->save();
        return $user;
    }
}
