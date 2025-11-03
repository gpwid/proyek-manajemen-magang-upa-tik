<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ChangelogController extends Controller
{
    public function index(): View
    {
        return view('admin.changelog.index');
    }
}
