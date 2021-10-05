<?php

// src/Controller/DefaultController.php

namespace App\Controller;

use App\Message\SmsNotification;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DelayStamp;

class DefaultController extends AbstractController
{
    public function index(MessageBusInterface $bus)
    {
        // will cause the SmsNotificationHandler to be called
        $bus->dispatch(new SmsNotification('Look! I created a message!'));

        // or use the shortcut
        //$this->dispatchMessage(new SmsNotification('Look! I created a message!'));

        $bus->dispatch(new SmsNotification('Look! DelayStamp of 5000'), [
            // wait 5 seconds before processing
            new DelayStamp(5000),
        ]);

        // or explicitly create an Envelope
        /*
        $bus->dispatch(new Envelope(new SmsNotification('...'), [
            new DelayStamp(5000),
        ]));
        */

        // ...
    }
}
