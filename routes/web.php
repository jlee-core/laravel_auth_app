<?php
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

Route::get('/mypage', function () {
    return view('mypage');
})->middleware('auth')->name('mypage');

Route::get('whoami', function() {
    return auth()->user()->name;
})->middleware('auth');

Route::middleware('api.token')->group(function () {
    Route::get('/todos', [TodoController::class, 'index']);
    Route::post('/todos', [TodoController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::get('todos/search', [TodoController::class, 'search'])
        ->name('todos.search');
    Route::resource('todos', TodoController::class);
});

Route::middleware(['auth', 'can:view-admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])
            ->name('dashboard');
    });

require __DIR__.'/settings.php';