<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CauseController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\WebsiteDetailController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/about', function () {
    return view('pages.about');
})->name('about');


Route::get('/service', function () {
    return view('pages.service');
})->name('service');

Route::get('/donate', function () {
    return view('pages.donate');
})->name('donate');

Route::get('/team', function () {
    return view('pages.team');
})->name('team');

Route::get('/testimonial', function () {
    return view('pages.testimonial');
})->name('testimonial');

Route::get('/volunteer', function () {
    return view('pages.volunteer');
})->name('volunteer');

Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

Route::get('/donate', function () {
    return view('pages.donate');
})->name('donate');

Route::get('/causes', [CauseController::class, 'index'])->name('causes.index');

// Show create form
Route::get('/causes/create', [CauseController::class, 'create'])->name('causes.create');

// Store new cause
Route::post('/causes', [CauseController::class, 'store'])->name('causes.store');

// Show single cause
Route::get('/causes/{cause}', [CauseController::class, 'show'])->name('causes.show');

// Show edit form
Route::get('/causes/{cause}/edit', [CauseController::class, 'edit'])->name('causes.edit');

// Update cause
Route::put('/causes/{cause}', [CauseController::class, 'update'])->name('causes.update');

// Delete cause
Route::delete('/causes/{cause}', [CauseController::class, 'destroy'])->name('causes.destroy');


// frontend form submit
Route::post('/submit-form', [SubmissionController::class, 'store'])->name('form.store');

// admin views
Route::get('/admin/submissions', [SubmissionController::class, 'index'])->name('submissions.index');
Route::get('/admin/submissions/{submission}', [SubmissionController::class, 'show'])->name('submissions.show');



Route::get('/admin/testimonials', [TestimonialController::class, 'index'])->name('testimonials.index');
Route::get('/admin/testimonials/create', [TestimonialController::class, 'create'])->name('testimonials.create');
Route::post('/admin/testimonials', [TestimonialController::class, 'store'])->name('testimonials.store');
Route::get('/admin/testimonials/{testimonial}/edit', [TestimonialController::class, 'edit'])->name('testimonials.edit');
Route::put('/admin/testimonials/{testimonial}', [TestimonialController::class, 'update'])->name('testimonials.update');
Route::delete('/admin/testimonials/{testimonial}', [TestimonialController::class, 'destroy'])->name('testimonials.destroy');


// routes/web.php


Route::prefix('admin')->group(function () {
    Route::get('website-details', [WebsiteDetailController::class, 'index'])->name('website-details.index');
    Route::get('website-details/edit', [WebsiteDetailController::class, 'edit'])->name('website-details.edit');
    Route::put('website-details', [WebsiteDetailController::class, 'update'])->name('website-details.update');
});

require __DIR__.'/auth.php';
