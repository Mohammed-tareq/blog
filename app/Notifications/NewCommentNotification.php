<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewCommentNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public $comment, public $post)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }

    public function toDatabase($notifiable)
    {
        return [
            'user_id' => auth()->user()->id, //or  $this->comment->user_id
            'user_name' => auth()->user()->name,
            'comment' => $this->comment->comment,
            "post_title" => $this->post->title,
            'link' => route('front.post.single-post', $this->post->slug),
        ];
    }

    public function toBroadcast($notifiable)
    {
        return [
            'user_id' => auth()->user()->id, //or  $this->comment->user_id
            'user_name' => auth()->user()->name,
            'comment' => $this->comment->comment,
            "post_title" => $this->post->title,
            'link' => route('front.post.single-post', $this->post->slug),
        ];
    }

    public function broadcastType()
    {
        return 'NewCommentNotification';
    }

    public function databaseType()
    {
        return 'NewCommentNotification';
    }
}
