<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\HtmlString;

class PasswordResetCodeNotification extends Notification
{
    use Queueable;

    public function __construct(public string $code) {}

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('আপনার পাসওয়ার্ড রিসেট কোড')
            ->greeting('হ্যালো!')
            ->line('আপনার পাসওয়ার্ড রিসেট করার জন্য নিচের কোডটি ব্যবহার করুন:')
            ->line(new HtmlString("<h1 style='letter-spacing:6px;text-align:center;'>{$this->code}</h1>"))
            ->line('এই কোডটি ১০ মিনিটের জন্য বৈধ থাকবে।')
            ->line('আপনি যদি এই রিকোয়েস্ট না করে থাকেন, এই ইমেইলটি উপেক্ষা করুন।');
    }
}