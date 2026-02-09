<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }
    
    public function profile()
    {
        return view('admin.profile');
    }
    
    public function settings()
    {
        return view('admin.settings');
    }
    
    public function billing()
    {
        return view('admin.billing');
    }
    
    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/');
    }
}