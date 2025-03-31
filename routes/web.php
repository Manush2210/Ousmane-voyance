<?php

use App\Models\Account;
use App\Livewire\Auth\Login;
use App\Livewire\Pages\Home;
use App\Livewire\Pages\Shop;
use App\Livewire\Pages\Search;
use App\Livewire\Auth\Register;
use App\Livewire\Pages\Contact;
use App\Livewire\Pages\Meeting;
use App\Livewire\Auth\ResetPassword;
use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Pages\SingleProduct;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Pages\AddAccount;
use App\Livewire\Admin\Pages\AddProduct;
use App\Livewire\Admin\Pages\Home as AdminHome;

// Routes d'authentification
Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
    // Route::get('/forgot-password', ForgotPassword::class)->name('password.request');
    // Route::get('/reset-password/{token}', ResetPassword::class)->name('password.reset');

    // Ajouter cette ligne pour la connexion admin
    Route::get('/admin/login', \App\Livewire\Auth\AdminLogin::class)->name('admin.login');
});

// Add logout route
Route::post('/logout', function () {
    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect('/');
})->middleware(['auth', 'web'])->name('logout');

// Routes protégées par l'authentification
Route::middleware('auth')->group(function () {
    // Route::get('/account', \App\Livewire\Pages\Account::class)->name('account');
    // Route::get('/account/orders', \App\Livewire\Pages\Account\Orders::class)->name('account.orders');
    // Route::get('/account/orders/{order}', \App\Livewire\Pages\Account\OrderDetail::class)->name('account.orders.detail');

    // Account routes
    Route::get('/profile', \App\Livewire\Pages\Account\Profil::class)->name('profile');
    Route::get('/order-history', \App\Livewire\Pages\Account\OrderHistory::class)->name('order-history');
});

// Routes d'administration (nécessitent le rôle admin)
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    // Ajouter cette ligne au début pour définir la redirection
    config(['auth.login_route' => 'admin.login']);

    // Route::get('/', AdminHome::class)->name('admin.home');
    Route::get('/products', \App\Livewire\Admin\Pages\Products::class)->name('admin.products');
    Route::get('/products/add', AddProduct::class)->name('admin.products.add');
    Route::get('/accounts/add', AddAccount::class)->name('admin.accounts.add');
    Route::get('/orders', \App\Livewire\Admin\Pages\Orders::class)->name('admin.orders');
    Route::get('/orders/{order}', \App\Livewire\Admin\Pages\OrderDetail::class)->name('admin.orders.detail');
    Route::get('/users', \App\Livewire\Admin\Pages\Users::class)->name('admin.users');
});

// Routes publiques
Route::get('/', Home::class)->name('home');
Route::get('/boutique', Shop::class)->name('shop');
Route::get('/boutique/{slug}', SingleProduct::class)->name('single-product');
Route::get('/recherche/{search?}', Search::class)->name('search');
Route::get('/contact', Contact::class)->name('contact');
Route::get('/prise-de-rendez-vous', Meeting::class)->name('meeting');
Route::get('/panier', \App\Livewire\Pages\Cart::class)->name('cart');

// Order routes
Route::get('/order', \App\Livewire\Pages\Order::class)->name('order');
