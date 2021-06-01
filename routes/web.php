<?php

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
});

Route::get('/chats/', [\App\Http\Controllers\ChatsController::class, 'fetchChats'])->middleware(['auth']);
Route::get('/chats/{id}/', function () {
    return view('chat');
})->middleware(['auth']);

Route::get('/api/chats/{id}/', [\App\Http\Controllers\ChatsController::class, 'fetchMessages'])->middleware(['auth']);
Route::post('/api/chats/{id}/', [\App\Http\Controllers\ChatsController::class, 'sendMessage'])->middleware(['auth']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
