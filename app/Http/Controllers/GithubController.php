<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GithubApiService;

class GithubController extends Controller
{
    protected $github;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');

        $this->github = new GithubApiService;
    }

    /**
     * Show a list of github users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->get('since', 135);

        $response = $this->github->get('users?since=' . $request->since);

        return response()->json($response);
    }

    /**
     * Show info about a github user.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $response = $this->github->get('users/' . $request->username);

        return response()->json($response);
    }

    /**
     * Show the repos of a github user.
     *
     * @return \Illuminate\Http\Response
     */
    public function repos(Request $request)
    {
        $response = $this->github->get('users/' . $request->username . '/repos');

        return response()->json($response);
    }


}
