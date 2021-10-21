<?php

// src/Handler/GreetingHandler.php

namespace App\Handler;

use App\Entity\Greeting;
use App\Entity\Notification;
use App\Repository\MediaObjectRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Handler\MessageSubscriberInterface;

final class GreetingHandler implements MessageSubscriberInterface
{
    private EntityManagerInterface $entityManager;
    private UserRepository $userRepository;
    private MediaObjectRepository $mediaObjectRepository;
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger, EntityManagerInterface $entityManager, UserRepository $userRepository, MediaObjectRepository $mediaObjectRepository)
    {
        $this->entityManager = $entityManager;
        $this->userRepository = $userRepository;
        $this->mediaObjectRepository = $mediaObjectRepository;
        $this->logger = $logger;
    }

    public function __invoke(Greeting $greeting)
    {
        // business logic

        echo 'I passed from the GreetingHandlerPrime # '.$greeting->message.' #'.$greeting->user_id.' #'.$greeting->document_id.' #';

        $notification = new Notification();
        $notification->setBody($greeting->message);
        $notification->setUser($this->userRepository->find($greeting->user_id));
        $notification->setDocument($this->mediaObjectRepository->find($greeting->document_id));

        $this->entityManager->persist($notification);
        $this->entityManager->flush();
        //$this->logger->debug('[ApiKeyAuthenticator] - got a token: '.$greeting->message);

        sleep(5);
    }

    public static function getHandledMessages(): iterable
    {
        yield Greeting::class => [
            'method' => '__invoke',
            // priority vs other handlers once message is handled
            // but unless you use priority transports... the message
            // will still be handled in the order it was received
            //'priority' => 1,
            // unnecessary: useful if a message has multiple handlers
            // and you want to "send" each handler to a separate transport
            'from_transport' => 'async',
        ];
    }
}
