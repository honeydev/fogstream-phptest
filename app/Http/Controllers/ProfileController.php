<?php

namespace News\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('news.profile', ['page' => 'Profile']);
    }

    /**
     * Show the update profile page
     *
     * @return \Illuminate\Http\Response
     */
    public function updatePage()
    {
        return view('news.update', ['page' => 'Update profile']);
    }
}
