<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\routeController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\UserController;
use App\Models\User;


Route::get('register', [RegisterController::class, 'index'])->name('register');
Route::post('register', [RegisterController::class, 'registrar']);

Route::get('/', [routeController::class,'inicio'])->name('inicio');
Route::get('/tienda', [routeController::class,'tienda'])->name('tienda');
Route::get('/contactos', [routeController::class,'contacto'])->name('contacto');
Route::post('/checkout', [routeController::class,'checkout'])->name('checkout');
Route::post('/detalle/{id}', [routeController::class,'detalle'])->name('detalle');

Route::post('/carrito/add', [CartController::class,'addToCart'])->name('add');
Route::post('/actualizar-cantidad', [CartController::class, 'actualizarCantidad'])->name('actualizarCantidad');
Route::get('/carrito', [CartController::class,'cart'])->name('cart');
Route::post('/carrito/remover', [CartController::class,'remover'])->name('remover');







Route::get('/google-auth/redirect', function () {
    return Socialite::driver('google')->redirect();
});
 
/*Route::get('/google-auth/callback', function () {
    $user_google = Socialite::driver('google')->stateless()->user();
    $user=User::updateOrCreate([
        'google_id' =>$user_google->id,
    ],
    [
        'name'=>$user_google->name,
        'email'=>$user_google->email,
    ]);
 
    // $user->token
    Auth::login($user);
    return redirect('/dashboard');
});*/


Route::middleware(['auth'])->group(function () {
    Route::get('/home', function () {
        return view('home');
    })->name('dashboard');
});

Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('inicio');
})->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Auth::routes();

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/products', ProductController::class);
Route::resource('/users', UserController::class);

Route::post('paypal/pay', [PayPalController::class,'payWithPayPal'])->name('paypal');
Route::get('paypal/execute', [PayPalController::class, 'executePayment'])->name('paypal.execute');
Route::get('paypal/cancel', [PayPalController::class, 'cancelPayment'])->name('paypal.cancel');


