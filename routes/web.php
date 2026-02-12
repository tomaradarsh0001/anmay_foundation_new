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
use App\Http\Controllers\RazorController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\RazorpayPaymentController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

/*
|--------------------------------------------------------------------------
| Admin Profile Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {

    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::put('/update', [ProfileController::class, 'update'])->name('update');
        Route::post('/change-password', [ProfileController::class, 'changePassword'])->name('password');
    });

});

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Logout
    Route::post('/logout', [DashboardController::class, 'logout'])->name('logout');

    /*
    |--------------------------------------------------------------------------
    | Admin Views
    |--------------------------------------------------------------------------
    */
    Route::get('/admin/submissions', [SubmissionController::class, 'index'])->name('submissions.index');
    Route::get('/admin/submissions/{submission}', [SubmissionController::class, 'show'])->name('submissions.show');

    Route::get('/admin/causes', [CauseController::class, 'index'])->name('causes.index');
    Route::get('/causes/create', [CauseController::class, 'create'])->name('causes.create');
    Route::post('/causes', [CauseController::class, 'store'])->name('causes.store');
    Route::get('/causes/{cause}', [CauseController::class, 'show'])->name('causes.show');
    Route::get('/causes/{cause}/edit', [CauseController::class, 'edit'])->name('causes.edit');
    Route::put('/causes/{cause}', [CauseController::class, 'update'])->name('causes.update');
    Route::delete('/causes/{cause}', [CauseController::class, 'destroy'])->name('causes.destroy');

    Route::get('/admin/testimonials', [TestimonialController::class, 'index'])->name('testimonials.index');
    Route::get('/admin/testimonials/create', [TestimonialController::class, 'create'])->name('testimonials.create');
    Route::post('/admin/testimonials', [TestimonialController::class, 'store'])->name('testimonials.store');
    Route::get('/admin/testimonials/{testimonial}/edit', [TestimonialController::class, 'edit'])->name('testimonials.edit');
    Route::put('/admin/testimonials/{testimonial}', [TestimonialController::class, 'update'])->name('testimonials.update');
    Route::delete('/admin/testimonials/{testimonial}', [TestimonialController::class, 'destroy'])->name('testimonials.destroy');

    Route::get('/admin/contacts', [ContactController::class, 'index'])->name('admin.contacts');
    Route::get('/admin/contacts/{id}', [ContactController::class, 'show'])->name('admin.contacts.show');
    Route::delete('/admin/contacts/{id}/delete', [ContactController::class, 'delete'])->name('admin.contacts.delete');

    Route::prefix('admin')->group(function () {
        Route::get('website-details', [WebsiteDetailController::class, 'index'])->name('website-details.index');
        Route::get('website-details/edit', [WebsiteDetailController::class, 'edit'])->name('website-details.edit');
        Route::put('website-details', [WebsiteDetailController::class, 'update'])->name('website-details.update');
    });

    /*
    |--------------------------------------------------------------------------
    | Admin Donation Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin')->group(function () {
        Route::get('/donations', [DonationController::class, 'index'])->name('admin.donations.index');
        Route::put('/donations/{id}/status', [DonationController::class, 'updateStatus'])->name('admin.donations.update-status');
        Route::delete('/donations/{id}', [DonationController::class, 'destroy'])->name('admin.donations.destroy');
    });

});

/*
|--------------------------------------------------------------------------
| Public Pages
|--------------------------------------------------------------------------
*/
Route::view('/about', 'pages.about')->name('about');
Route::view('/causes', 'pages.causes')->name('causes');
Route::view('/service', 'pages.service')->name('service');
Route::view('/donate', 'pages.donate')->name('donate');
Route::view('/team', 'pages.team')->name('team');
Route::view('/testimonial', 'pages.testimonial')->name('testimonial');
Route::view('/volunteer', 'pages.volunteer')->name('volunteer');
Route::view('/contact', 'pages.contact')->name('contact');
Route::view('/make-donation', 'pages.phonepay')->name('make-donation');

/*
|--------------------------------------------------------------------------
| Form Submissions
|--------------------------------------------------------------------------
*/
Route::post('/submit-form', [SubmissionController::class, 'store'])->name('form.store');
Route::post('/donations/submit', [DonationController::class, 'submit'])->name('donations.submit');
Route::post('/submit-form-contact', [ContactController::class, 'store'])->name('form.store.contact');

/*
|--------------------------------------------------------------------------
| Payment Routes (PhonePe)
|--------------------------------------------------------------------------
*/
Route::post('/payment/auto-check', [PhonepayController::class, 'autoCheckPendingPayments'])
    ->middleware('auth:api')
    ->name('payment.autoCheck');

Route::post('/payment/check-realtime', [PhonepayController::class, 'checkPaymentStatusRealtime'])
    ->name('payment.check.realtime');

Route::get('/payment/callback/realtime', [PhonepayController::class, 'paymentCallbackRealtime'])
    ->name('payment.callback.realtime');

Route::get('/donate-now-phonepay', [PhonepayController::class, 'showDonationForm'])->name('donate-now');
Route::post('/initiate-payment', [PhonepayController::class, 'initiatePayment'])->name('initiate-payment');
Route::get('/payment/callback', [PhonepayController::class, 'paymentCallback'])->name('payment.callback');
Route::get('/payment/failed', [PhonepayController::class, 'paymentFailed'])->name('payment.failed');
Route::post('/payment/check-status', [PhonepayController::class, 'checkPaymentStatus'])->name('payment.checkStatus');

/*
|--------------------------------------------------------------------------
| Razorpay Routes (PhonePe)
|--------------------------------------------------------------------------
*/
Route::get('/donate-now-razorpay', [RazorpayPaymentController::class, 'showDonationForm'])->name('razorpay.donation.form');
Route::post('/razorpay/initiate', [RazorpayPaymentController::class, 'initiatePayment'])->name('razorpay.initiate');
Route::post('/razorpay/verify', [RazorpayPaymentController::class, 'verifyPayment'])->name('razorpay.verify');
Route::get('/razorpay/success', [RazorpayPaymentController::class, 'paymentSuccess'])->name('razorpay.success');
Route::get('/razorpay/failed', [RazorpayPaymentController::class, 'paymentFailed'])->name('razorpay.failed');
Route::get('/razorpay/status/{merchantOrderId}', [RazorpayPaymentController::class, 'getPaymentStatus'])->name('razorpay.status');

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function() {
    
    // Razorpay Payments Management
    Route::prefix('payments/razorpay')->name('payments.razorpay.')->group(function() {
        Route::get('/', [RazorpayPaymentController::class, 'index'])->name('index');
        Route::get('/export', [RazorpayPaymentController::class, 'export'])->name('export');
        Route::get('/{id}', [RazorpayPaymentController::class, 'show'])->name('show');
        Route::put('/{id}/status', [RazorpayPaymentController::class, 'updateStatus'])->name('status');
        Route::delete('/payments/razorpay/{id}', [RazorpayPaymentController::class, 'destroy'])
    ->name('destroy');

    });
    
});

/*
|--------------------------------------------------------------------------
| Admin Payment Management
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::prefix('payments')->name('payments.')->group(function () {
        Route::get('/', [PaymentController::class, 'index'])->name('index');
        Route::get('/{id}', [PaymentController::class, 'show'])->name('show');
        Route::delete('/{id}', [PaymentController::class, 'destroy'])->name('destroy');
        Route::get('/export', [PaymentController::class, 'export'])->name('export');
    });
});

/*
|--------------------------------------------------------------------------
| Fallback Route
|--------------------------------------------------------------------------
*/
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});

require __DIR__.'/auth.php';
