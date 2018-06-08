<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GithubController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Show a list of github users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return response()->json('github boysss!');
    }

    /**
     * Show info about a github user.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return response()->json('github boysss!');
    }

    /**
     * Show the repos of a github user.
     *
     * @return \Illuminate\Http\Response
     */
    public function repos(Request $request)
    {
        return response()->json('github boysss!');
    }


}
