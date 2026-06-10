<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function index()
    {
        return view('public.contact.index');
    }

    public function store()
    {
        // Placeholder for contact form submission
    }
}

