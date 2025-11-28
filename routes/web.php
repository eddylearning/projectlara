<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\User\UserCarController;
use App\Http\Controllers\Admin\AdminCarController;
use App\Http\Controllers\Payment\PaymentController;
use App\Http\Controllers\Admin\PaymentLogController;
use App\Http\Controllers\User\UserBookingController;
use App\Http\Controllers\Admin\AdminReportController;
use App\Http\Controllers\Auth\RoleRedirectController;
use App\Http\Controllers\Admin\AdminBookingController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Employee\EmployeeBookingController;
use App\Http\Controllers\Employee\EmployeeDashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/cars', [CarController::class, 'index'])->name('cars');
Route::get('/contact', [ContactController::class, 'show'])->name('contact');
//added code below so that form submition can be definded//
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/welcome', [WelcomeController::class, 'index'])->name('welcome');
Route::get('/redirect/dashboard', RoleRedirectController::class)
    ->middleware(['auth'])->name('redirect.dashboard');



           //admin routes
// Route::prefix('admin')->name('admin.')->group(function (){
//     Route::resource('cars', AdminCarController::class)->name('dashboard');
// });
// Route::prefix('admin')->name('admin.')->group(function () {
//     Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
// });
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Admin dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Admin car CRUD routes
    Route::resource('cars', AdminCarController::class);

    // Admin report CRUD routes
    Route::resource('reports', AdminReportController::class);
      // Payment logs routes
    Route::prefix('payment-logs')->group(function () {
        Route::get('/', [PaymentLogController::class, 'index'])->name('payments.logs'); // admin.payments.logs
        Route::get('/{id}', [PaymentLogController::class, 'show'])->name('payments.logs.show'); // admin.payments.logs.show
        Route::get('/export/pdf', [PaymentLogController::class, 'exportPdf'])->name('payments.logs.pdf'); // admin.payments.logs.pdf
    });

    // Export routes
    Route::get('/bookings/export/pdf', [AdminBookingController::class, 'exportPdf'])->name('admin.bookings.export.pdf');

//admin contact message
   Route::prefix('messages')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\MessageController::class, 'index'])->name('messages.index');
        Route::get('/{id}', [\App\Http\Controllers\Admin\MessageController::class, 'show'])->name('messages.show');
    });

    
  // ADMIN booking routes
        Route::prefix('bookings')->name('bookings.')->group(function () {
            Route::get('/', [AdminBookingController::class, 'index'])->name('index');
            Route::get('/{booking}', [AdminBookingController::class, 'show'])->name('show');

            // admin status update shortcuts
            Route::get('/{booking}/approve', [AdminBookingController::class, 'approve'])->name('approve');
            Route::get('/{booking}/complete', [AdminBookingController::class, 'complete'])->name('complete');
            Route::get('/{booking}/cancel', [AdminBookingController::class, 'cancel'])->name('cancel');
        });
        
        //payment mangament
    Route::get('/payments', [AdminPaymentController::class, 'index'])->name('index');


});

Route::middleware(['auth', 'employee'])->prefix('employee')->name('employee.')->group(function () {
    Route::get('/dashboard', [EmployeeDashboardController::class, 'index'])->name('dashboard');

    // Employee cars CRUD routes
    Route::resource('cars', EmployeeCarController::class);

       // Employee bookings CRUD routes
  Route::prefix('bookings')->name('bookings.')->group(function () {
            Route::get('/', [EmployeeBookingController::class, 'index'])->name('index');
            Route::get('/create', [EmployeeBookingController::class, 'create'])->name('create');
            Route::post('/', [EmployeeBookingController::class, 'store'])->name('store');
            Route::get('/{booking}', [EmployeeBookingController::class, 'show'])->name('show');
            Route::patch('/{booking}', [EmployeeBookingController::class, 'update'])->name('update');
            Route::delete('/{booking}', [EmployeeBookingController::class, 'destroy'])->name('destroy');
        });
});

Route::middleware(['auth', 'user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
 // user car CRUD routes
    Route::resource('cars', UserCarController::class);
    //booking CRUD routes
      Route::prefix('bookings')->name('bookings.')->group(function () {
            Route::get('/', [UserBookingController::class, 'index'])->name('index');
            Route::get('/create', [UserBookingController::class, 'create'])->name('create');
            Route::post('/', [UserBookingController::class, 'store'])->name('store');
            Route::get('/{booking}', [UserBookingController::class, 'show'])->name('show');
            Route::delete('/{booking}', [UserBookingController::class, 'destroy'])->name('destroy');
        });
});

//payment and checkout routes
Route::get('/payment/checkout/{booking}', [PaymentController::class, 'checkout'])
    ->middleware(['auth'])
    ->name('payment.checkout');

Route::post('/payment/process', [PaymentController::class, 'process'])
    ->middleware(['auth'])
    ->name('payment.process');

Route::post('/mpesa/callback', [PaymentController::class, 'callback'])
    ->name('mpesa.callback');   // no auth - Safaricom needs access    

Route::get('/payment/success/{booking}', [PaymentController::class, 'success'])
    ->name('payment.success');

Route::get('/payment/failed/{booking}', [PaymentController::class, 'failed'])
    ->name('payment.failed');

Route::get('/payment/status/{booking}', [PaymentController::class, 'status'])
    ->name('payment.status');

Route::get('/my-payments', function() {
    $payments = \App\Models\Payment::with('booking.car')
                ->whereHas('booking', function($q) {
                    $q->where('user_id', auth()->id());
                })
                ->latest()
                ->get();

    return view('payments.history', compact('payments'));
})->name('payments.history')->middleware('auth');



// debug to check the actula user loged in
Route::get('/debug-role', function () {
    $user = auth()->user();
    if ($user) {
        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'role' => $user->role
        ]);
    } else {
        return response('No user is logged in', 401);
    }
});

// used to check if a single user has access to more than one dashboard
Route::get('/test-roles', function () {
    $user = auth()->user();
    if (!$user) return 'Not logged in';

    $check = function ($middleware) {
        try {
            $middlewareInstance = app($middleware);
            $middlewareInstance->handle(request(), fn () => 'allowed');
            return true; // middleware passed
        } catch (\Throwable $e) {
            return false; // middleware blocked or threw 403
        }
    };

    return [
        'id' => $user->id,
        'name' => $user->name,
        'role' => $user->role,
        'can_access_user_dashboard' => $check(\App\Http\Middleware\UserMiddleware::class),
        'can_access_employee_dashboard' => $check(\App\Http\Middleware\EmployeeMiddleware::class),
        'can_access_admin_dashboard' => $check(\App\Http\Middleware\AdminMiddleware::class),
    ];
});

