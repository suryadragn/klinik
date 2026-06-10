<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;

class DoctorController extends Controller
{
    public function index()
    {
        return view('public.doctors.index');
    }

    public function show(string $slug)
    {
        return view('public.doctors.show', compact('slug'));
    }
}

