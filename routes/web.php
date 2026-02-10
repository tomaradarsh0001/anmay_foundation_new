<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CauseController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\WebsiteDetailController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\PhonepayController;


use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Profile
    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
    
    // Logout
    Route::post('/logout', [DashboardController::class, 'logout'])->name('logout');

    
// admin views
Route::get('/admin/submissions', [SubmissionController::class, 'index'])->name('submissions.index');
Route::get('/admin/submissions/{submission}', [SubmissionController::class, 'show'])->name('submissions.show');

Route::get('/admin/causes', [CauseController::class, 'index'])->name('causes.index');

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


Route::get('/admin/testimonials', [TestimonialController::class, 'index'])->name('testimonials.index');
Route::get('/admin/testimonials/create', [TestimonialController::class, 'create'])->name('testimonials.create');
Route::post('/admin/testimonials', [TestimonialController::class, 'store'])->name('testimonials.store');
Route::get('/admin/testimonials/{testimonial}/edit', [TestimonialController::class, 'edit'])->name('testimonials.edit');
Route::put('/admin/testimonials/{testimonial}', [TestimonialController::class, 'update'])->name('testimonials.update');
Route::delete('/admin/testimonials/{testimonial}', [TestimonialController::class, 'destroy'])->name('testimonials.destroy');

Route::get('/admin/contacts', [ContactController::class, 'index'])->name('admin.contacts');
Route::get('/admin/contacts/{id}', [ContactController::class, 'show'])->name('admin.contacts.show');


Route::prefix('admin')->group(function () {
    Route::get('website-details', [WebsiteDetailController::class, 'index'])->name('website-details.index');
    Route::get('website-details/edit', [WebsiteDetailController::class, 'edit'])->name('website-details.edit');
    Route::put('website-details', [WebsiteDetailController::class, 'update'])->name('website-details.update');
});

});



Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::get('/causes', function () {
    return view('pages.causes');
})->name('causes');

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


Route::get('/make-donation', function () {
    return view('pages.phonepay');
})->name('make-donation');


// frontend form submit
Route::post('/submit-form', [SubmissionController::class, 'store'])->name('form.store');


// Public donation route
Route::post('/donations/submit', [DonationController::class, 'submit'])->name('donations.submit');

// Admin routes (protected with admin middleware)
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/donations', [DonationController::class, 'index'])->name('admin.donations.index');
    Route::put('/donations/{id}/status', [DonationController::class, 'updateStatus'])->name('admin.donations.update-status');
    Route::delete('/donations/{id}', [DonationController::class, 'destroy'])->name('admin.donations.destroy');
});


Route::post('/submit-form-contact', [ContactController::class, 'store'])->name('form.store.contact');

Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});

// PhonePe Donation Routes
Route::get('/donate-now', [PhonepayController::class, 'showDonationForm'])->name('donate-now');
Route::post('/initiate-payment', [PhonepayController::class, 'initiatePayment'])->name('initiate-payment');
Route::get('/donation/success', [PhonepayController::class, 'paymentSuccess'])->name('payment.success');
Route::get('/donation/failure', [PhonepayController::class, 'paymentFailure'])->name('payment.failure');


require __DIR__.'/auth.php';
