<?php

// src/Handler/GreetingHandler2.php

namespace App\Handler;

use App\Entity\Greeting;
use App\Repository\UserRepository;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Handler\MessageSubscriberInterface;
use Symfony\Component\Mime\Email;

final class GreetingHandler2 implements MessageSubscriberInterface
{
    private MailerInterface $mailer;
    private UserRepository $userRepository;

    public function __construct(MailerInterface $mailer, UserRepository $userRepository)
    {
        $this->mailer = $mailer;
        $this->userRepository = $userRepository;
    }

    /**
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
    public function __invoke(Greeting $greeting)
    {
        // business logic

        echo 'I passed from the GreetingHandler2 # '.$greeting->message.' #'.$greeting->user_id.' #'.$greeting->document_id.' #';

        $email = (new Email())
            ->from('test@mail.com')
            ->to($this->userRepository->find($greeting->user_id)->getUserIdentifier())
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html($greeting->message);

        $this->mailer->send($email);

        sleep(5);
    }

    public static function getHandledMessages(): iterable
    {
        yield Greeting::class => [
            'method' => '__invoke',
            // priority vs other handlers once message is handled
            // but unless you use priority transports... the message
            // will still be handled in the order it was received
            //'priority' => 2,
            // unnecessary: useful if a message has multiple handlers
            // and you want to "send" each handler to a separate transport
            'from_transport' => 'async_priority_high',
        ];
    }
}
