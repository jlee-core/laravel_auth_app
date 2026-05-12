<?php

namespace App\Services;

use App\Models\Todo;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use App\Notifications\TodoCreatedNotification;
use Illuminate\Notifications\Notifiable;

class TodoService
{
    public function create(array $data): Todo
    {

        $todo = Todo::create([
            'title' => $data['title'],
            'body' => $data['body'] ?? null,
            'is_done' => false,
        ]);

        return $todo;
    }
}
