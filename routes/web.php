<?php

// --- Use Statements ---
use App\Livewire\Auth\Login;
use App\Livewire\Pages\Cart;

// Public Pages
use App\Livewire\Pages\Home;
use App\Livewire\Pages\Shop;
use App\Livewire\Pages\Order;
use App\Livewire\Pages\Search;
use App\Livewire\Auth\Register;
use App\Livewire\Pages\Contact;
use App\Livewire\Pages\Meeting;

// Authentication
use App\Livewire\Auth\AdminLogin;
use App\Livewire\Admin\Pages\Users;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Admin\Pages\Settings;
use App\Livewire\Admin\Pages\Testimonials;


// Customer Account Area
use App\Livewire\Pages\SingleProduct;
use Illuminate\Support\Facades\Route;

// Admin Panel
use App\Livewire\Admin\Pages\Products;
use App\Livewire\Pages\Account\Profil;
use App\Livewire\Admin\Pages\AddAccount;
use App\Livewire\Admin\Pages\AddProduct;
use App\Http\Controllers\MailTestController;
use App\Livewire\Admin\Pages\PaymentMethods;
use App\Livewire\Pages\Account\OrderHistory;
use App\Livewire\Admin\Pages\ConsultationTypes;

// --- Controllers ---
use App\Livewire\Admin\Pages\Orders as AdminOrders;
use App\Livewire\Admin\Pages\OrderDetail as AdminOrderDetail;


/*
|--------------------------------------------------------------------------
| 1. Public Routes
|--------------------------------------------------------------------------
|
| Accessibles par tous les visiteurs. C'est la vitrine de votre site.
|
*/
Route::get('/', Home::class)->name('home');
Route::get('/boutique', Shop::class)->name('shop');
Route::get('/boutique/{slug}', SingleProduct::class)->name('single-product');
Route::get('/recherche/{search?}', Search::class)->name('search');
Route::get('/panier', Cart::class)->name('cart');

// Routes avec formulaires publics (sensibles au spam)
Route::get('/contact', Contact::class)->name('contact');
Route::get('/prise-de-rendez-vous', Meeting::class)->name('meeting');


/*
|--------------------------------------------------------------------------
| 2. Authentication Routes
|--------------------------------------------------------------------------
|
| Gèrent la connexion, l'inscription et la déconnexion des utilisateurs
| et des administrateurs. Points d'entrée critiques pour la sécurité.
|
*/
Route::middleware('guest')->group(function () {
    // User Authentication
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');

    // Admin Authentication
    Route::get('/admin/login', AdminLogin::class)->name('admin.login');
});

Route::post('/logout', function () {
    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect('/');
})->middleware('auth')->name('logout');


/*
|--------------------------------------------------------------------------
| 3. Authenticated User Area (Customer Account)
|--------------------------------------------------------------------------
|
| Routes accessibles uniquement aux utilisateurs connectés.
| Groupées sous le middleware 'auth'.
|
*/
Route::middleware('auth')->group(function () {
    // Processus de commande
    Route::get('/order', Order::class)->name('order');

    // Espace client
    Route::prefix('mon-compte')->group(function () {
        Route::get('/profil', Profil::class)->name('profile');
        Route::get('/historique-commandes', OrderHistory::class)->name('order-history');
    });
});


/*
|--------------------------------------------------------------------------
| 4. Admin Panel Routes
|--------------------------------------------------------------------------
|
| Section critique, protégée par les middlewares 'auth' et 'admin'.
| Toutes les routes sont préfixées par '/admin' et leurs noms par 'admin.'.
|
*/
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    // Redirection en cas d'échec d'authentification pour le panel admin
    config(['auth.login_route' => 'admin.login']);

    // Gestion du contenu
    Route::get('/products', Products::class)->name('products');
    Route::get('/products/add', AddProduct::class)->name('products.add');
    Route::get('/consultation-types', ConsultationTypes::class)->name('consultation-types');
    Route::get('/testimonials', Testimonials::class)->name('testimonials');

    // Site settings
    Route::get('/settings', Settings::class)->name('settings');

    // Gestion des ventes
    Route::get('/orders', AdminOrders::class)->name('orders');
    Route::get('/orders/{order}', AdminOrderDetail::class)->name('orders.detail');

    // Gestion des utilisateurs
    Route::get('/users', Users::class)->name('users');
    Route::get('/accounts/add', AddAccount::class)->name('accounts.add');

    // Configuration
    Route::get('/payment-methods', PaymentMethods::class)->name('payment-methods');
});


/*
|--------------------------------------------------------------------------
| 5. Development Routes
|--------------------------------------------------------------------------
|
| Routes utilitaires pour le développement.
| !! NE DOIVENT PAS ÊTRE ACCESSIBLES EN PRODUCTION !!
|
*/
if (app()->environment('local')) {
    Route::get('/test-email', [MailTestController::class, 'testEmail'])->name('test-email');
}
