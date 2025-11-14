<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        return view('admin.settings.index');
    }

    public function update(Request $request)
    {
        // You can store settings in database or .env later
        return back()->with('success', 'Settings updated successfully!');
    }
}
