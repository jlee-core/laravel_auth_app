<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Todo;

class TodoCreatedForUser extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public Todo $todo
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Todoを作成しました',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.todo-created-user',
            with: [
                'todo' => $this->todo,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
