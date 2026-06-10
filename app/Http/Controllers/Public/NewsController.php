<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    public function index()
    {
        return view('public.news.index');
    }

    public function show(string $slug)
    {
        return view('public.news.show', compact('slug'));
    }
}

