<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Changelog;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ChangelogController extends Controller
{
    public function index(): View|RedirectResponse
    {
        $changelogs = Changelog::latest()->get();
        $user = Auth::user();

        if (! $user) {
            return redirect()->route('login');
        }

        if ($user->isAdmin()) {
            return view('admin.changelog.index', compact('changelogs'));
        }

        if ($user->isPembimbing()) {
            return view('pembimbing.changelog.index', compact('changelogs'));
        }

        if ($user->isPemagang()) {
            return view('pemagang.changelog.index', compact('changelogs'));
        }

        if ($user->isAtasan()) {
            return view('atasan.changelog.index', compact('changelogs'));
        }

        // fallback: generic view or reuse admin view
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
