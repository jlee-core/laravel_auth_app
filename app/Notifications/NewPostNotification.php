<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewPostNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        protected string $postTitle
    ) {
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('新しい投稿が追加されました')
            ->line("投稿タイトル：{$this->postTitle}")
            ->action('投稿を確認する', url('/posts'))
            ->line('このメッセージは自動送信されました。');
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'message' => "新しい投稿：{$this->postTitle}",
            'url' => url('/posts'),
        ];
    }
}
