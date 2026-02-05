<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::latest()->get();
        return view('testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('testimonials.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'text' => 'required|string',
            'name' => 'required|string|max:255',
            'profession' => 'required|string|max:255',
        ]);

        Testimonial::create($data);

        return redirect()->route('testimonials.index')->with('success', 'Testimonial added!');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $data = $request->validate([
            'text' => 'required|string',
            'name' => 'required|string|max:255',
            'profession' => 'required|string|max:255',
        ]);

        $testimonial->update($data);

        return redirect()->route('testimonials.index')->with('success', 'Updated successfully!');
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        return back()->with('success', 'Deleted successfully!');
    }
}
