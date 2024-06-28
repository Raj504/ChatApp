<?php
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::middleware(['auth',])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/message', [App\Http\Controllers\MessageController::class, 'index'])->name('message.index');
    // Route::get('/chat', [MessageController::class, 'index'])->name('chat.index');
    // Route::post('/chat/message', [MessageController::class, 'sendMessage'])->name('chat.sendMessage');

    Route::post('/chat/message', [MessageController::class, 'sendMessage']);
    Route::put('/chat/message/{id}', [MessageController::class, 'updateMessage']);
    Route::delete('/chat/message/{id}', [MessageController::class, 'deleteMessage']);
    Route::get('/chat', [MessageController::class, 'index']);
   

});
