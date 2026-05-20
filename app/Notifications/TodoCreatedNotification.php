<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Todo;

class TodoCreatedNotification extends Notification
{
    use Queueable;

    public function __construct(
        public Todo $todo
    ) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'message' => "Todo「{$this->todo->title}」を作成しました。",
            'url' => route('todos.index'),
            'todo_id' => $this->todo->id,
        ];
    }
}
