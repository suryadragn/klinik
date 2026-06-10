<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class NewsPostController extends Controller
{
    public function index()
    {
        return view('admin.news-posts.index');
    }

    public function create()
    {
        return view('admin.news-posts.create');
    }

    public function store()
    {
        // Placeholder for server-side CRUD store
    }

    public function edit(string $id)
    {
        return view('admin.news-posts.edit', compact('id'));
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
