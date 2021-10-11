<?php

// src/Handler/GreetingHandler.php

namespace App\Handler;

use App\Entity\Greeting;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class GreetingHandler implements MessageHandlerInterface
{
    public function __invoke(Greeting $greeting)
    {
        // business logic
        /*$greeting->user = 'theUser';
        $greeting->message = 'theMessage';
        $greeting->document = 'theDoc';

        return $greeting;*/

        //echo 'Sending email now ...';

        sleep(5);
    }
}
