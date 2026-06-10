<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;

class GalleryController extends Controller
{
    public function index()
    {
        return view('public.gallery.index');
    }
}

