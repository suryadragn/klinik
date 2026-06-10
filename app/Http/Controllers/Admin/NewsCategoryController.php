<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class NewsCategoryController extends Controller
{
    public function index()
    {
        return view('admin.news-categories.index');
    }

    public function create()
    {
        return view('admin.news-categories.create');
    }

    public function store()
    {
        // Placeholder for server-side CRUD store
    }

    public function edit(string $id)
    {
        return view('admin.news-categories.edit', compact('id'));
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
