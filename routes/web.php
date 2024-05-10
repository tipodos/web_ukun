<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\routeController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [routeController::class,'inicio'])->name('inicio');
Route::get('/tienda', [routeController::class,'tienda'])->name('tienda');
Route::get('/contactos', [routeController::class,'contacto'])->name('contacto');
Route::get('/checkout', [routeController::class,'checkout'])->name('checkout');
Route::post('/detalle/{id}', [routeController::class,'detalle'])->name('detalle');

Route::post('/carrito/add', [CartController::class,'addToCart'])->name('add');
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

Route::get('/dashboard', function () {
    return view('admin.template');
})->middleware(['auth', 'verified'])->name('dashboard');

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


