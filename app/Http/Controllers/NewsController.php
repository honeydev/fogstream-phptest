<?php

namespace News\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        return view('news.news', ['page' => 'Main page']);
    }
}
