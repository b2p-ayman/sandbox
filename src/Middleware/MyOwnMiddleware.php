<?php

namespace App\Middleware;

//use App\Message\Stamp\AnotherStamp;
use App\Entity\Notification;
use App\Repository\MediaObjectRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Middleware\MiddlewareInterface;
use Symfony\Component\Messenger\Middleware\StackInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Messenger\Stamp\ReceivedStamp;
use Symfony\Component\Messenger\Stamp\SentStamp;

class MyOwnMiddleware extends AbstractController implements MiddlewareInterface
{
    private $userRepository;
    private $mediaObjectRepository;

    public function __construct(UserRepository $userRepository, MediaObjectRepository $mediaObjectRepository)
    {
        $this->userRepository = $userRepository;
        $this->mediaObjectRepository = $mediaObjectRepository;
    }

    public function handle(Envelope $envelope, StackInterface $stack): Envelope
    {
        if (null !== $envelope->last(ReceivedStamp::class)) {
            // Message just has been received
            // Add another stamp
            //$envelope = $envelope->with(new AnotherStamp(/* ... */));
        }
        $body = ((array) $envelope->getMessage());

        $notification = new Notification();
        $notification->setBody($body['message']);
        $notification->setUser($this->userRepository->find($body['user_id']));
        $notification->setDocument($this->mediaObjectRepository->find($body['document_id']));

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($notification);
        $entityManager->flush();

        //echo 'I passed from MyOwnMiddleware';

        return $stack->next()->handle($envelope, $stack);
    }
}
