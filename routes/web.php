<?php

use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordLinkController;
use App\Http\Controllers\Auth\ForgotPasswordController;
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
//Route::get('/unsubscribe/success', function () {
//    return view('unsubscribe.success');
//})->name('unsubscribe.success');
//
//Route::get('/unsubscribe/error', function () {
//    return view('unsubscribe.error');
//})->name('unsubscribe.error');

//success page email has been sent
Route::get('/reset-password/success', function () {
    return view('password.success');
})->name('password.success');



/*
|--------------------------------------------------------------------------
|                                Admin Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/admin/dashboard', [UserController::class, 'adminDashboard'])->name('adminDashboard')->middleware('auth', 'role:admin');
///////////////////////////    Events
Route::get('/events/admin',[EventController::class,'aprroveEvent'])->name('events.admin')->middleware('auth', 'role:admin');
Route::post('/events/{event}/approve', [EventController::class, 'approve'])->name('events.approve')->middleware('auth', 'role:admin');
Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('event.destroy')->middleware('auth', 'role:admin');



/*
|--------------------------------------------------------------------------
|                                Homepage
|--------------------------------------------------------------------------
*/
Route::get('/home', function () {
    return view('home');
})->name('home');



Route::get('/', [EventController::class,'affiche'])->name('welcome');

Route::get('/events/search', [EventController::class,'searchEvents'])->name('events.search');


//display single page
Route::get('events/{id}', [EventController::class, 'show'])->name('event.single');
//ticket form
Route::get('/ticketForm/{eventId}', [ReservationController::class, 'showPaymentForm'])->name('ticketForm');

///
///////////////////////////////                Events by category
///
//Route::get('events/by/category', [EventController::class, 'showEventByCategory'])->name('events.category');
Route::get('/events/category/{categoryId}', [EventController::class, 'showEventByCategory'])
    ->name('events.category');
////////////////////////////////           Search
///


/*
|--------------------------------------------------------------------------
|                                User auth
|--------------------------------------------------------------------------
*/
Route::post('/reserve', [ReservationController::class,'store'])->name('reservation.store');

Route::get('/ticket/{ticketId}', [ReservationController::class, 'showTicket'])->name('ticket.show');
Route::get('/tickets/{ticket}/download', [TicketController::class, 'download'])->name('ticket.download');






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
|                                Admin Actions
|-----------------------------------------------------------------
*/

Route::middleware('auth', 'role:admin')->group(function () {

    ////////////////////            users list                ///////////////////////////////
    Route::get('/usersList', [UserController::class, 'index'])->name('usersList');

    ////////////////////            change users role                ///////////////////////////////
    Route::put('/users/{user}', [UserController::class, 'update'])->name('updateUserRole');
    /////////////////////////          SOFT DELETE             ////////////////////////////////
    Route::delete('/users/{userId}', [UserController::class, 'destroy'])->name('users.destroy');
    //restore users interface
    Route::get('/admin/restored-users', [UserController::class, 'trashed'])->name('restore');
    //restore method
    Route::put('/users/{userId}/restore', [UserController::class, 'restore'])->name('users.restore');



    ////////////////////            categories list                ///////////////////////////////
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    Route::post('/add-category', [CategoryController::class, 'store'])->name('add_category');
    Route::delete('/delete-category/{id}', [CategoryController::class, 'deleteCategory'])->name('delete_category');
    Route::post('/update_category/{id}', [CategoryController::class, 'update'])->name('update_category');







});






/*
|--------------------------------------------------------------------------
|                                Organizer Dashboard
|--------------------------------------------------------------------------
*/
Route::get('/organizer/dashboard', [UserController::class, 'editorDashboard'])->name('writerDashboard')->middleware('auth', 'role:organizer');

/*
|--------------------------------------------------------------------------
|                                Organizer Actions
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:organizer'])->group(function () {

    /////////////////////////              ADD & Display Events                  ///////////////////////////////
    Route::get('/events',[EventController::class,'index'])->name('events.organizer');
    Route::post('/events/store', [EventController::class, 'store'])->name('events.store');

    //template form
    Route::get('/eventForm', [EventController::class,'showEventForm'])->name('addEvent');
    //delete
    Route::delete('/myevents/{event}', [EventController::class, 'destroyOrganizer'])->name('myevents.delete');
    //update
    Route::get('/events/{event}/edit', [EventController::class, 'showEventFormUpdate'])->name('events.edit');

    Route::post('/eventsUpdate/{event}', [EventController::class, 'update'])->name('events.update');

    /////////////////////////////////////        Reservations          ////////////////////////////////////////////////////
    Route::get('reservations/list',[ReservationController::class,'showReservationList'])->name('reservations.organizer');
    //approve
    Route::post('/reservations/{id}/approve', [ReservationController::class,'approve'])->name('reservations.approve');
    //decline
    Route::delete('/reservations/{id}/decline', [ReservationController::class,'decline'])->name('reservations.decline');




});











