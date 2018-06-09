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
        $page = $request->page ?: 1;
        $per_page = $request->per_page ?: 20;

        $response = $this->github->get('users?page=' . $page . '&per_page=' . $per_page);

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
