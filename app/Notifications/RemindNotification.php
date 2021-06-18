<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RemindNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($item)
    {
        $this->item = $item;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if($this->item->remind_day === 0) {
            $context = "本日のTodo「{$this->item->todo_list}」のリマインドです";
        };
        if($this->item->remind_day === 1) {
            $context = "「{$this->item->todo_list}」の1日前リマインドです";
        };
        if($this->item->remind_day === 2) {
            $context = "「{$this->item->todo_list}」の2日前リマインドです";
        }
        return (new MailMessage)
                    ->subject("リマインド通知")
                    ->line($notifiable->name . "様")
                    ->line($context)
                    ->action('Todolistを確認', url('http://localhost:8080/login'))
                    ->salutation('Todolist運営より');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
