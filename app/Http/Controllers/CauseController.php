<?php

namespace App\Http\Controllers;

use App\Models\Cause;
use Illuminate\Http\Request;

class CauseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $causes = Cause::latest()->get();
    return view('causes.index', compact('causes'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
            return view('causes.create');

    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    $data = $request->validate([
        'name' => 'required',
        'heading' => 'required',
        'content' => 'required',
        'target_goal' => 'required|numeric',
        'raised' => 'nullable|numeric',
        'image' => 'required|image',
    ]);

    $data['image'] = $request->file('image')->store('causes', 'public');

    Cause::create($data);

    return redirect()->back()->with('success', 'Cause created successfully');
}


    /**
     * Display the specified resource.
     */
    public function show(Cause $cause)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
   public function edit(Cause $cause)
{
    return view('causes.edit', compact('cause'));
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cause $cause)
{
    $data = $request->validate([
        'name' => 'required',
        'heading' => 'required',
        'content' => 'required',
        'target_goal' => 'required|numeric',
        'raised' => 'nullable|numeric',
        'image' => 'nullable|image',
    ]);

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('causes', 'public');
    }

    $cause->update($data);

    return redirect()->route('causes.index')->with('success', 'Updated');
}


    /**
     * Remove the specified resource from storage.
     */
  public function destroy(Cause $cause)
{
    $cause->delete();
    return redirect()->back()->with('success', 'Deleted');
}

}
