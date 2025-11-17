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
use App\Http\Controllers\User\UserBookingController;
use App\Http\Controllers\Admin\AdminReportController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\Admin\AdminDashboardController;
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
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
//added code below so that form submition can be definded//
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/welcome', [WelcomeController::class, 'index'])->name('welcome');

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

});

Route::middleware(['auth', 'employee'])->prefix('employee')->name('employee.')->group(function () {
    Route::get('/dashboard', [EmployeeDashboardController::class, 'index'])->name('dashboard');

    // Employee bookings CRUD routes
    Route::resource('bookings', EmployeeBookingController::class);

    // Employee cars CRUD routes
    Route::resource('cars', EmployeeCarController::class);

});

Route::middleware(['auth', 'user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
 // user car CRUD routes
    Route::resource('cars', UserCarController::class);
    Route::resource('booking',UserBookingController::class);
    Route::get('bookings', [UserBookingController::class, 'index'])->name('bookings.index');
    Route::get('bookings/create', [UserBookingController::class, 'create'])->name('bookings.create');
    Route::post('bookings', [UserBookingController::class, 'store'])->name('bookings.store');
    Route::delete('bookings/{booking}', [UserBookingController::class, 'destroy'])->name('bookings.destroy');
    Route::get('bookings/{booking}', [UserBookingController::class, 'show'])->name('bookings.show');

});

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

