<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Payments;

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


Route::get('/obrigado', function () {
    if ( Session::has( 'link_boleto' ) || Session::has( 'pagamento_ok')) : //apenas pra teste - em prod não colocaria regras na rota
        return view('obrigado');
    endif;
    return abort('404');
    
})->name('obrigado');


Route::post('/payments', [Payments::class, 'index']);