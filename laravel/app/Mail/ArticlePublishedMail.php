<?php

namespace App\Mail;

use App\Models\Article;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ArticlePublishedMail extends Mailable
{
    use Queueable, SerializesModels;

    public Article $article;

    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->article->title . ' par ' . $this->article->author,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.article-published',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
