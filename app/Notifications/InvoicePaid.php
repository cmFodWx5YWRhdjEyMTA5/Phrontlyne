<?php

namespace Phrontlyne\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use NotificationChannels\Hubtel\HubtelChannel;
use NotificationChannels\Hubtel\HubtelMessage;

class InvoicePaid extends Notification
{
    use Queueable;

  
    public function via($notifiable)
    {
        return [HubtelChannel::class];
    }

   public function toSMS($notifiable)
    {
        return (new HubtelMessage)
            ->from("Gilead")
            ->to("233541448708")
            ->content("Kim Kippo... Sup with you");
    }
}
