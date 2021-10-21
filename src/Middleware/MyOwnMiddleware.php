<?php

namespace App\Middleware;

//use App\Message\Stamp\AnotherStamp;
use App\Repository\MediaObjectRepository;
use App\Repository\UserRepository;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Middleware\MiddlewareInterface;
use Symfony\Component\Messenger\Middleware\StackInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Messenger\Stamp\ReceivedStamp;

class MyOwnMiddleware extends AbstractController implements MiddlewareInterface
{
    private $userRepository;
    private $mediaObjectRepository;
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger, UserRepository $userRepository, MediaObjectRepository $mediaObjectRepository)
    {
        $this->userRepository = $userRepository;
        $this->mediaObjectRepository = $mediaObjectRepository;
        $this->logger = $logger;
    }

    public function handle(Envelope $envelope, StackInterface $stack): Envelope
    {
        //if (null !== $envelope->last(ReceivedStamp::class)) {
        // Message just has been received
        // Add another stamp
        //$envelope = $envelope->with(new AnotherStamp(/* ... */));
        //}

        //$this->logger->debug('[ApiKeyAuthenticator] - got a token: '.serialize($envelope->getMessage()));

        //echo 'I passed from MyOwnMiddleware';

        //$handledStamp = $envelope->last(HandledStamp::class);

        return $stack->next()->handle($envelope, $stack);
    }
}
