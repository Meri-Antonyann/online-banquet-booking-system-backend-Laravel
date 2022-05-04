<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\MessageToAdminController;
use App\Http\Controllers\PassportAuthController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\ServiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('register', [PassportAuthController::class, 'register'])->name('auth.register');
Route::post('login', [PassportAuthController::class, 'login'])->name('auth.login');
Route::post('forgotpassword', [ResetPasswordController::class, 'sendEmail'])->name('reset');
Route::post('reset', [ResetPasswordController::class, 'reset'])->name('resetpassword');
Route::get('getContact', [CompanyController::class, 'getcontact'])->name('get');
Route::get('getInfo', [CompanyController::class, 'getInfo'])->name('info');
Route::get('getservices', [ServiceController::class, 'getservices'])->name('getservice');
Route::get('getevents', [EventController::class, 'getevents'])->name('getevent');
Route::post('messageToAdmin', [MessageToAdminController::class, 'GuestMessage'])->name('message');
Route::get('getGuestMessage', [MessageToAdminController::class, 'GetGuestMessage'])->name('GetGuestMessage');
Route::delete('deleteQuery/{id}', [MessageToAdminController::class, 'deleteQuery'])->name('deleteQuery');

Route::middleware('auth:api')->group(function () {
    Route::get('me', [PassportAuthController::class, 'me'])->name('auth.me');
    Route::post('update', [PassportAuthController::class, 'update'])->name('auth.me');
    Route::post('changePsw/{id}', [PassportAuthController::class, 'changePsw'])->name('changePsw');
    Route::post('addevent', [EventController::class, 'addevent'])->name('event');
    Route::get('delete-event/{id}', [EventController::class, 'deleteEvent'])->name('delevent');
    Route::get('showevent/{id}', [EventController::class, 'showevent'])->name('showevent');
    Route::post('updateevent/{id}', [EventController::class, 'updateevent'])->name('update-event');
    Route::post('logout', [PassportAuthController::class, 'logout'])->name('logout');



    Route::post('addservice', [ServiceController::class, 'addservice'])->name('service');
    Route::get('delete-service/{id}', [ServiceController::class, 'deleteService'])->name('delservice');
    Route::get('showservice/{id}', [ServiceController::class, 'showservice'])->name('showservice');
    Route::post('updateservice/{id}', [ServiceController::class, 'updateservice'])->name('update-service');
    Route::get('getusers', [PassportAuthController::class, 'getUsers'])->name('users');
    Route::post('updatecontacts', [CompanyController::class, 'updatecontacts'])->name('contacts');
    Route::post('aboutUs', [CompanyController::class, 'aboutUs'])->name('about');
    Route::post('storeBooking', [BookingController::class, 'store'])->name('booking');
    Route::get('getQueries', [BookingController::class, 'getQueries'])->name('getQueries');
    Route::get('approve/{id}', [BookingController::class, 'approve'])->name('approve');
    Route::get('reject/{id}', [BookingController::class, 'reject'])->name('reject');
    Route::get('getMyQueries', [BookingController::class, 'getMyQueries'])->name('getMyQueries');
    Route::get('counts', [BookingController::class, 'counts'])->name('counts');
    Route::get('getApproved', [BookingController::class, 'approved'])->name('approved');
    Route::get('getCancelled', [BookingController::class, 'cancelled'])->name('cancelled');
    Route::get('getServices', [ServiceController::class, 'services'])->name('services');
    Route::get('getEvents', [EventController::class, 'events'])->name('events');
    Route::get('livesearch', [BookingController::class, 'search'])->name('search');
    Route::get('newBooking', [BookingController::class, 'newBooking'])->name('newBooking');
    Route::get('getNewBookings', [BookingController::class, 'getNewBookings'])->name('getNewBookings');
    Route::get('getCancelledBookings', [BookingController::class, 'getCancelledBookings'])->name('getCancelledBookings');
    Route::get('getApprovedBookings', [BookingController::class, 'getApprovedBookings'])->name('getApprovedBookings');
    Route::get('getUnreadBookings', [BookingController::class, 'getUnreadBookings'])->name('getUnreadBookings');
    Route::get('unread', [BookingController::class, 'unread'])->name('unread');
    Route::get('getReadBookings', [BookingController::class, 'getReadBookings'])->name('getReadBookings');
    Route::get('ReadBookings', [BookingController::class, 'ReadBookings'])->name('ReadBookings');
    Route::get('getBookings', [BookingController::class, 'getBookings'])->name('getBookings');
    Route::post('sendRemark/{id}', [MessageToAdminController::class, 'sendRemark'])->name('sendRemark');
    Route::get('remarks', [MessageToAdminController::class, 'getRemark'])->name('getRemark');
    Route::post('bookingsForSomePeriod', [BookingController::class, 'bookingsForSomePeriod'])->name('bookingsForSomePeriod');

});
