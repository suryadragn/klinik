<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function index()
    {
        return view('public.profile.index');
    }
}

