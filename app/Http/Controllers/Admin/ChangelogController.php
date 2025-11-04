<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Changelog;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ChangelogController extends Controller
{
    public function index(): View
    {
        $changelogs = Changelog::latest()->get();

        return view('admin.changelog.index', compact('changelogs'));
    }

    public function create(): View
    {
        return view('admin.changelog.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Changelog::create($validated);

        return redirect()->route('admin.changelog.index')->with('success', 'Changelog berhasil ditambahkan.');
    }
}
