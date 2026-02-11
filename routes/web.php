<?php

use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\CauseController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\WebsiteDetailController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\PhonepayController;
use App\Http\Controllers\Admin\PaymentController;


use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Admin Profile Routes
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::put('/update', [ProfileController::class, 'update'])->name('update');
        Route::post('/change-password', [ProfileController::class, 'changePassword'])->name('password');
    });
});

Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Profile
    
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
// Delete a contact
Route::delete('/admin/contacts/{id}/delete', [ContactController::class, 'delete'])->name('admin.contacts.delete');


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
// Auto-check pending payments (protected route)
Route::post('/payment/auto-check', [PhonepayController::class, 'autoCheckPendingPayments'])
    ->middleware('auth:api') // Or use API token
    ->name('payment.autoCheck');
    // Real-time status checking
Route::post('/payment/check-realtime', [PhonepayController::class, 'checkPaymentStatusRealtime'])
    ->name('payment.check.realtime');

// Alternative callback route for real-time checking
Route::get('/payment/callback/realtime', [PhonepayController::class, 'paymentCallbackRealtime'])
    ->name('payment.callback.realtime');
// PhonePe Donation Routes
Route::get('/donate-now', [PhonepayController::class, 'showDonationForm'])->name('donate-now');

// Initiate payment (AJAX)
Route::post('/initiate-payment', [PhonepayController::class, 'initiatePayment'])->name('initiate-payment');

// Payment callback (PhonePe redirects here after payment)
Route::get('/payment/callback', [PhonepayController::class, 'paymentCallback'])->name('payment.callback');

// Payment failure callback (separate failure URL)
Route::get('/payment/failed', [PhonepayController::class, 'paymentFailed'])->name('payment.failed');

// Check payment status (AJAX)
Route::post('/payment/check-status', [PhonepayController::class, 'checkPaymentStatus'])
    ->name('payment.checkStatus');


// Admin routes
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    // Payment management
    Route::prefix('payments')->name('payments.')->group(function () {
        Route::get('/', [PaymentController::class, 'index'])->name('index');
        Route::get('/{id}', [PaymentController::class, 'show'])->name('show');
        Route::delete('/{id}', [PaymentController::class, 'destroy'])->name('destroy');
        Route::get('/export', [PaymentController::class, 'export'])->name('export');
             // Status check routes
        Route::post('/{id}/check-status', [PaymentController::class, 'checkStatus'])
            ->name('checkStatus');
        
        Route::post('/bulk-check-status', [PaymentController::class, 'bulkCheckStatus'])
            ->name('bulkCheckStatus');
    });
});


require __DIR__.'/auth.php';
