<?php

// app/Http/Controllers/WebsiteDetailController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WebsiteDetail;

class WebsiteDetailController extends Controller
{
    // Show the website details
    public function index()
    {
        $detail = WebsiteDetail::first();
        return view('website_details.index', compact('detail'));
    }

    // Show the edit form
    public function edit()
    {
        $detail = WebsiteDetail::first();
        return view('website_details.edit', compact('detail'));
    }

    // Update website details
    public function update(Request $request)
    {
        $detail = WebsiteDetail::first();

        // All fields optional, no required validation
        $detail->update([
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'instagram' => $request->instagram,
            'twitter' => $request->twitter,
            'facebook' => $request->facebook,
            'linkedin' => $request->linkedin,
            'youtube' => $request->youtube,
        ]);

        return redirect()->route('website-details.index')->with('success', 'Website details updated successfully.');
    }
}
