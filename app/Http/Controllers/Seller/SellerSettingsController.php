<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Admin\Controller;
use Illuminate\Http\Request;

class SellerSettingsController extends Controller
{
    public function index()
    {
        return view('seller.settings.index');
    }

    public function update(Request $request)
    {
        // handle saving settings here later
        return back()->with('success', 'Settings updated!');
    }
}
