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

Route::post('contact', function (Request $request) {

    Mail::to(['returntheplastics@gmail.com', 'rik.stallaerts@gmail.com'])->send(new ContactMail(
        $request->subject,
        $request->content,
        $request->name,
        $request->email
    ));
    return redirect()->back()->with('success', 'Your message has been sent. Thank you!');
})->name('contact');
