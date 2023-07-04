<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RazorpayController;

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

Route::get('/', [PageController::class, 'home']);

Route::get('refund-policy', [PageController::class, 'refundPolicy']);

Route::get('about-us', [PageController::class, 'aboutUs']);

Route::get('contact-us', [PageController::class, 'contactUs']);

Route::get('term-of-use', [PageController::class, 'termOfUse']);

Route::get('cookies-policy', [PageController::class, 'cookiesPolicy']);

Route::get('faq', [PageController::class, 'faq']);

Route::get('privacy-policy', [PageController::class, 'privacyPolicy']);

Route::get('search-email', [PageController::class, 'searchEmail']);

Route::post('user/login', [LoginController::class, 'postLogin']);

Route::post('/payment-page', [PageController::class, 'paymentPage']);

Route::get('razorpay', [RazorpayController::class, 'razorpay'])->name('razorpay');
Route::post('razorpaypayment', [RazorpayController::class, 'payment'])->name('payment');

Route::get('login', [LoginController::class, 'login']);
Route::get('registeration', [LoginController::class, 'registeration']);

Route::post('manual-login', [LoginController::class, 'manualLogin']);
Route::post('post-registration', [LoginController::class, 'postRegistration']);

Route::get('logout', [LoginController::class, 'logout']);

Route::get('my-order/{user_id}', [PageController::class, 'myOrder']);

Route::post('cancel/order', [PageController::class, 'cancelOrder']);

Route::get('about-gift-box', [PageController::class, 'aboutGiftBox']);

