<?php

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/privacy', function () {
    return view('privacy');
})->name('privacy');

Route::post('contact', function (Request $request) {

    try {
        Log::info("Sending email to the admin contacts...");

        $contacts = ['rik.stallaerts@gmail.com', 'returntheplastics@gmail.com'];
        // $contacts = ['returntheplastics@gmail.com'];

        Mail::to($contacts)->send(new ContactMail(
            $request->subject,
            $request->content,
            $request->name,
            $request->email
        ));

        Log::info("Mail sent successfully!");
        return redirect()->back()->with('success', 'Your message has been sent. Thank you!');
    } catch (Exception $e) {
        Log::error("Email couldn't be sent. Reason; " . $e->getMessage());
        return $e->getMessage();
    }
})->name('contact');
