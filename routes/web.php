<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactReceived;
use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\NewPostNotification;
use App\Http\Controllers\NotificationController;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

Route::get('/mypage', function () {
    return view('mypage');
})->middleware('auth')->name('mypage');

Route::get('whoami', function () {
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


Route::get('/send-test', function () {
    if (! app()->environment('local')) {
        abort(404);
    }

    Mail::to('j.lee@core-tech.jp')
        ->send(new TestMail());

    return '送信しました。Mailtrapで確認してください。';
});

Route::get('/send-contact-mail', function () {
    if (! app()->environment('local')) {
        abort(404);
    }

    $name = '人事1課';
    $email = 'developer@example.com';
    $messageBody = 'こちらはお問い合わせ内容のテストです。';

    Mail::to($email)
        ->send(new ContactReceived($name, $email, $messageBody));

    return '送信しました。Mailtrapで確認してください。';
});

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/contact', function (Request $request) {
    $validated = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email'],
        'message' => ['required', 'string', 'max:1000'],
    ]);

    Mail::to($validated['email'])
        ->queue(new ContactReceived(
            $validated['name'],
            $validated['email'],
            $validated['message']
        ));

    return back()->with('success', 'お問い合わせを受け付けました。');
})->name('contact.send');

Route::get('/notify', function () {
    $user = User::first();

    if (! $user) {
        return '通知先のユーザーが存在しません。先にユーザーを作成してください。';
    }

    $user->notify(new NewPostNotification('サンプル投稿タイトル'));

    return '通知を送信しました（Mailtrap・DBで確認）';
})->name('notify');

Route::get('/notifications', [NotificationController::class, 'index'])
    ->middleware('auth')
    ->name('notifications.index');

require __DIR__ . '/settings.php';
