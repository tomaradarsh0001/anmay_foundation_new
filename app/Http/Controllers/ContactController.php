<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormSubmitted;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

            // Create the contact record
            $contact = Contact::create($data);
            
            // Send email to the user
            Mail::to($contact->email)->send(new ContactFormSubmitted($contact));
            
            // Optional: Send notification email to admin
            // Mail::to('admin@example.com')->send(new ContactFormAdminNotification($contact));

            return response()->json([
                'success' => true,
                'message' => 'Form submitted successfully! We have sent you a confirmation email.'
            ]);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->errors(),
                'message' => 'Please check your input and try again.'
            ], 422);
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Contact form error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again later.'
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
        $contact = Contact::findOrFail($id);
        return view('contacts.show', compact('contact'));
    }

    public function delete($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->route('admin.contacts')->with('success', 'Message deleted successfully!');
    }
}