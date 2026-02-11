<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{

  public function store(Request $request)
    {
        try {
            $data = $request->validate([
               'first_name' => 'required|string|max:100',
                'last_name'  => 'required|string|max:100',
                'email'      => 'required|email|max:150',
                'phone'      => 'nullable|string|max:20',
                'message'    => 'required|string',
            ]);

            Contact::create($data);

            return response()->json([
                'success' => true,
                'message' => 'Form submitted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again.'
            ], 500);
        }
    }


public function index()
{
    $contacts = Contact::latest()->paginate(10);
    return view('contacts.index', compact('contacts'));
}
public function show($id)
{
    $contact = Contact::findOrFail($id); // fetch single contact message
    return view('contacts.show', compact('contact'));
}

public function delete($id)
{
    $contact = Contact::findOrFail($id);
    $contact->delete();

    return redirect()->route('admin.contacts')->with('success', 'Message deleted successfully!');
}

}
