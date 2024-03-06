<?php

use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordLinkController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\EmailListController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\UserController;








/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
|--------------------------------------------------------------------------
|                       Emails Pages redirect
|--------------------------------------------------------------------------
*/
Route::get('/unsubscribe/success', function () {
    return view('unsubscribe.success');
})->name('unsubscribe.success');

Route::get('/unsubscribe/error', function () {
    return view('unsubscribe.error');
})->name('unsubscribe.error');

//success page email has been sent
Route::get('/reset-password/success', function () {
    return view('password.success');
})->name('password.success');


/*
|--------------------------------------------------------------------------
|                                Homepage
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('home');
})->name('home');
//Route::get('/home',[NewsletterController::class, 'index'])->name('home');


/*
|--------------------------------------------------------------------------
|                        Subscription and Unsubscription
|--------------------------------------------------------------------------
*/
Route::post('/subscribe',[NewsletterController::class,'subscribe']);
Route::post('/unsubscribe', [NewsletterController::class, 'unsubscribe'])->name('unsubscribe');
Route::get('/unsubscribe/{token}',  [NewsletterController::class, 'unsubscribe'])->name('unsubscribe');






/*
|--------------------------------------------------------------------------
|                                Register
|--------------------------------------------------------------------------
*/
Route::get('/register', [RegisterController::class, 'create']);
Route::post('/register', [RegisterController::class, 'store'])->name('register');

/*
|--------------------------------------------------------------------------
|                                Login
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'create']);
Route::post('/login', [LoginController::class, 'store'])->name('login');

//google login
Route::get('auth/google', [GoogleController::class, 'redirect'])->name('google-auth');
Route::get('auth/google/callback', [GoogleController::class, 'callbackGoogle']);

/*
|--------------------------------------------------------------------------
|                                Forgot password
|                                 enter & send email
|--------------------------------------------------------------------------
*/

// Route for showing the form to enter the email
Route::get('/forgot-password', [ForgotPasswordLinkController::class, 'create'])
    ->name('password.request');
// Route for handling form submission
Route::post('/forgot-password', [ForgotPasswordLinkController::class, 'store'])
    ->name('password.email');

/*
|--------------------------------------------------------------------------
|                                Forgot password
|                                 reset password
|--------------------------------------------------------------------------
*/
// Display the password reset form
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])
    ->name('password.reset');
// Process the password reset form submission
Route::post('/reset-password/{token}', [ForgotPasswordController::class, 'reset'])
    ->name('password.update');


/*
|--------------------------------------------------------------------------
|                                Logout
|--------------------------------------------------------------------------
*/
Route::post('/logout', [Logoutcontroller::class, 'destroy'])->name('logout')
    ->middleware('auth');







/*
|--------------------------------------------------------------------------
|                                Admin Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/admin/dashboard', [UserController::class, 'adminDashboard'])->name('adminDashboard')->middleware('auth', 'role:admin');
///////////////////////////    Events
Route::get('/events/admin',[EventController::class,'aprroveEvent'])->name('events.admin')->middleware('auth', 'role:admin');
Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy')->middleware('auth', 'role:admin');
Route::post('/events/{event}/approve', [EventController::class, 'approve'])->name('events.approve')->middleware('auth', 'role:admin');


/*
|--------------------------------------------------------------------------
|                                Admin Actions
|-----------------------------------------------------------------
*/

Route::middleware('auth', 'role:admin')->group(function () {



    ////////////////////            users list                ///////////////////////////////
    Route::get('/usersList', [UserController::class, 'index'])->name('usersList');

    ////////////////////            categories list                ///////////////////////////////
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    Route::post('/add-category', [CategoryController::class, 'store'])->name('add_category');
    Route::delete('/delete-category/{id}', [CategoryController::class, 'deleteCategory'])->name('delete_category');
    Route::post('/update_category/{id}', [CategoryController::class, 'update'])->name('update_category');




    ////////////////////            change users role                ///////////////////////////////
    Route::put('/users/{user}', [UserController::class, 'update'])->name('updateUserRole');
    /////////////////////////          SOFT DELETE             ////////////////////////////////
    Route::delete('/users/{userId}', [UserController::class, 'destroy'])->name('users.destroy');
    //restore users interface
    Route::get('/admin/restored-users', [UserController::class, 'trashed'])->name('restore');
    //restore method
    Route::put('/users/{userId}/restore', [UserController::class, 'restore'])->name('users.restore');









});






/*
|--------------------------------------------------------------------------
|                                Organizer Dashboard
|--------------------------------------------------------------------------
*/
Route::get('/organizer/dashboard', [UserController::class, 'editorDashboard'])->name('writerDashboard')->middleware('auth', 'role:organizer');

/*
|--------------------------------------------------------------------------
|                                Writer Actions
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:organizer'])->group(function () {

    /////////////////////////              ADD & Display Events                  ///////////////////////////////
    Route::get('/events',[EventController::class,'index'])->name('events.organizer');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');

    //template form
    Route::get('/eventForm', [EventController::class,'showEventForm'])->name('addEvent');



});











