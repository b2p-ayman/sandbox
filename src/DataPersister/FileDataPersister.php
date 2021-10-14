<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\File;
use App\Factory\Email;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Security\Core\Security;

final class FileDataPersister implements ContextAwareDataPersisterInterface
{
    private EntityManagerInterface $entityManager;
    private $decorated;
    private $mailer;
    private $user;
    private Email $email;

    public function __construct(EntityManagerInterface $entityManager,
                                ContextAwareDataPersisterInterface $decorated,
                                MailerInterface $mailer,
                                Security $security,
                                Email $email)
    {
        $this->entityManager = $entityManager;
        $this->decorated = $decorated;
        $this->mailer = $mailer;
        $this->user = $security->getUser();
        $this->email = $email;
    }

    public function supports($data, array $context = []): bool
    {
        return $data instanceof File ? $this->decorated->supports($data, $context) : false;
    }

    public function persist($data, array $context = [])
    {
        /*
        $this->entityManager->persist($data);
        $this->entityManager->flush();
        */
        $result = $this->decorated->persist($data, $context);

        if (Request::METHOD_POST === strtoupper($context['collection_operation_name']) && null !== $this->user) {
            $email = $this->email->create(
                $this->user->getUserIdentifier(),
                'test@mail.fr',
                'File #'.$data->getId(),
                $data->getDescription()
            );
            $this->mailer->send($email);
        }
    }

    public function remove($data, array $context = [])
    {
        /*
        $this->entityManager->remove($data);
        $this->entityManager->flush();
        */
        return $this->decorated->remove($data, $context);
    }
}
