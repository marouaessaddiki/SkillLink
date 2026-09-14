<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class PlatformNotification extends Notification
{
    use Queueable;

    public function __construct(
        public string $message,
        public ?int $missionId = null,
        public ?int $applicationId = null,
    ) {
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        return array_filter([
            'message' => $this->message,
            'mission_id' => $this->missionId,
            'application_id' => $this->applicationId,
        ], static fn ($value) => $value !== null);
    }
}
