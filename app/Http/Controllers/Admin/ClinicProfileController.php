<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ClinicProfileController extends Controller
{
    public function index()
    {
        return view('admin.clinic-profile.index');
    }
}

