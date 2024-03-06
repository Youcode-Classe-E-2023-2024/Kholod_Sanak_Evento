<?php

use App\Http\Controllers\Auth\GoogleController;
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
//redirect admin to the dashboard admin
//Route::get('/adminDashboard', function () {
//    return view('admin.dashboard');
//})->name('adminDashboard')->middleware('auth', 'role:admin');
Route::get('/admin/dashboard', [UserController::class, 'adminDashboard'])->name('adminDashboard')->middleware('auth', 'role:admin');

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


    //////////////////////////           Show subs          //////////////////////////////////////////
   Route::get('/subsList', [EmailListController::class, 'showSubscribers'])->name('subsList');

    //Route::view('/subsList', 'admin.subs')->name('subsList');
    //Route::view('/templates', 'admin.template')->name('templates');

    ////////////////////////       Templates display      ////////////////////////////////////////
    Route::get('/templates', [NewsletterController::class, 'view'])->name('templates');
    Route::post('add/template', [NewsletterController::class, 'saveAdmin'])->name('save_template');

    //template form
    Route::view('/templateForm', 'writer.templateForm')->name('addTemplate');
    //send template
    Route::post('/newsletter/send/{id}', [NewsletterController::class,'sendAdmin'])->name('send_newsletter_template');

    //soft delete template
    Route::post('delete/template/{id}', [NewsletterController::class, 'deleteNewsletter'])->name('delete_template');


});






/*
|--------------------------------------------------------------------------
|                                Writer Dashboard
|--------------------------------------------------------------------------
*/
//redirect editor to the dashboard writer
//Route::get('/writerDashboard', function () {
//    return view('writer.dashboard');
//})->name('writerDashboard')->middleware('auth', 'role:editor');
Route::get('/writer/dashboard', [UserController::class, 'editorDashboard'])->name('writerDashboard')->middleware('auth', 'role:organizer');

/*
|--------------------------------------------------------------------------
|                                Writer Actions
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'can:create templates', 'can:send templates', 'can:track templates',
    'can:add medias', 'can:download users'])->group(function () {

    /////////////////////////              ADD    MEDIA                    ///////////////////////////////
    Route::post('/upload', [MediaController::class, 'upload'])->name('upload');
    //Route::post('/uploadImage', [MediaController::class, 'store'])->name('uploadImage');

    // form to add media
     Route::get('/AddMedia', [MediaController::class, 'index'])->name('addMedia');
    // For rendering the upload form
    //Route::get('/media/upload', [MediaController::class,'showMediaForm'])->name('media.upload');

    // index page of lists of medias
    Route::get('/medias', [MediaController::class,'showMediaList'])->name('media');
    //delete media
    Route::delete('/media/{id}', [MediaController::class,'destroy'])->name('media.delete');


    ////////////////////////////////           Display subs           ////////////////////////////////////////
    Route::get('/subscribers', [EmailListController::class, 'showSubscribers'])->name('subscribers');
    //generate pdf
    Route::get('/generate-pdf', [PdfController::class, 'generatePdf'])->name('generate.pdf');



    // Route::view('/writerSubsList', 'writer.subs')->name('writerSubsList');

    //////////////////////////////             Create newsletter             /////////////////////////////////////
    Route::post('add/template', [NewsletterController::class, 'save'])->name('save_newsletter_template');
    // show lists of template
    Route::get('/template', [NewsletterController::class, 'index'])->name('template');

    //template form
    Route::view('/templateForm', 'writer.templateForm')->name('addTemplate');
    //send template
    Route::post('/newsletter/send/{id}', [NewsletterController::class,'send'])->name('send_newsletter_template');

    //Route::post('/send/test', [NewsletterController::class,'sendTry'])->name('test');
});











