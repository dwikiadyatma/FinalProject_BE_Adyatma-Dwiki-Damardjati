<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});

// Show all inventory in shop page
Route::get('/shop', 'App\Http\Controllers\Items_Controller@show_item_cards')->name('shop');



// Add item to cart
Route::get('/add_cart/{item_id}', 'App\Http\Controllers\Cart_Controller@add_cart')->middleware(['auth'])->name('add_cart');
// Display all items in cart
Route::get('/cart', 'App\Http\Controllers\Cart_Controller@display_cart')->middleware(['auth'])->name('cart');
// go to update cart item page 
Route::get('/cart-edit/{id}', 'App\Http\Controllers\Cart_Controller@update_cart')->middleware(['auth'])->name('update_cart');
// edit the cart item data
Route::PATCH('/cart_editing/{id}', 'App\Http\Controllers\Cart_Controller@cart_editing')->middleware(['auth'])->name('cart_editing');
// delete item from cart
Route::delete('/delete_cartitem/{id}', 'App\Http\Controllers\Cart_Controller@delete_cartitem')->middleware(['auth'])->name('delete_cartitem');
// CHECKOUT
Route::post('/checkout', 'App\Http\Controllers\Cart_Controller@checkout')->middleware(['auth'])->name('checkout');

// Admin stuff
    // CRUD item

    // go to create item page
    Route::get('/add', 'App\Http\Controllers\Items_Controller@add')->middleware(['admin'])->name('add');
    // create the new item from form data
    Route::post('/add_item', 'App\Http\Controllers\Items_Controller@add_item')->middleware(['admin'])->name('add_item');
    // display all items (admin view)
    Route::get('/admin-inventory', 'App\Http\Controllers\Items_Controller@show_item_inventory')->middleware(['admin'])->name('show_item_inventory');
    // go to edit page for item from admin view page
    Route::get('/admin-edit/{id}', 'App\Http\Controllers\Items_Controller@update_item')->middleware(['admin'])->name('update_item');
    // edit the item data
    Route::PATCH('/editing/{id}', 'App\Http\Controllers\Items_Controller@admin_editing')->middleware(['admin'])->name('updating_item');
    // delete item from inventory
    Route::delete('/delete/{id}', 'App\Http\Controllers\Items_Controller@delete_item')->middleware(['admin'])->name('delete_item');
    // Display all invoices
    Route::get('/admin-view-invoices', 'App\Http\Controllers\Cart_Controller@display_invoices')->middleware(['admin'])->name('admin_view_invoices');
    // view single invoice details
    Route::get('/admin-view-invoice/{id}', 'App\Http\Controllers\Cart_Controller@view_invoice')->middleware(['admin'])->name('view_invoice');

// general
Route::get('/', function () {
    return view('landing');
})->name('landing');

