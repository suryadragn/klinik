<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class GalleryController extends Controller
{
    public function index()
    {
        return view('admin.galleries.index');
    }

    public function create()
    {
        return view('admin.galleries.create');
    }

    public function store()
    {
        // Placeholder for server-side CRUD store
    }

    public function edit(string $id)
    {
        return view('admin.galleries.edit', compact('id'));
    }

    public function update(string $id)
    {
        // Placeholder for server-side CRUD update
    }

    public function destroy(string $id)
    {
        // Placeholder for server-side CRUD delete
    }
}
