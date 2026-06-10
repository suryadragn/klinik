<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ContactMessageController extends Controller
{
    public function index()
    {
        return view('admin.contact-messages.index');
    }

    public function show(string $id)
    {
        return view('admin.contact-messages.show', compact('id'));
    }

    public function destroy(string $id)
    {
        // Placeholder for server-side CRUD delete
    }
}
