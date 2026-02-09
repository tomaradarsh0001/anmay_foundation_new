<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DonationController extends Controller
{
    public function index()
    {
        $donations = Donation::orderBy('created_at', 'desc')->get();
        return view('donations.index', compact('donations'));
    }
    
    public function submit(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'utr_number' => 'required|string|max:50',
            'screenshot' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        try {
            // Handle file upload
            $screenshotPath = null;
            if ($request->hasFile('screenshot')) {
                $file = $request->file('screenshot');
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $screenshotPath = $file->storeAs('donations/screenshots', $filename, 'public');
            }
            
            // Create donation record
            $donation = Donation::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'amount' => $request->amount,
                'utr_number' => $request->utr_number,
                'screenshot_path' => $screenshotPath,
                'status' => 'pending'
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Donation details submitted successfully!',
                'data' => $donation
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
    
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:verified,rejected',
            'admin_notes' => 'nullable|string'
        ]);
        
        $donation = Donation::findOrFail($id);
        $donation->update([
            'status' => $request->status,
            'admin_notes' => $request->admin_notes
        ]);
        
        return redirect()->back()->with('success', 'Status updated successfully!');
    }
    
    public function destroy($id)
    {
        $donation = Donation::findOrFail($id);
        
        // Delete screenshot file if exists
        if ($donation->screenshot_path && Storage::disk('public')->exists($donation->screenshot_path)) {
            Storage::disk('public')->delete($donation->screenshot_path);
        }
        
        $donation->delete();
        
        return redirect()->back()->with('success', 'Donation record deleted successfully!');
    }
}