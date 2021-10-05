<?php

namespace App\Middleware;

//use App\Message\Stamp\AnotherStamp;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Middleware\MiddlewareInterface;
use Symfony\Component\Messenger\Middleware\StackInterface;
use Symfony\Component\Messenger\Stamp\ReceivedStamp;

class MyOwnMiddleware implements MiddlewareInterface
{
    public function handle(Envelope $envelope, StackInterface $stack): Envelope
    {
        if (null !== $envelope->last(ReceivedStamp::class)) {
            // Message just has been received
            // Add another stamp
            //$envelope = $envelope->with(new AnotherStamp(/* ... */));
        }

        return $stack->next()->handle($envelope, $stack);
    }
}
