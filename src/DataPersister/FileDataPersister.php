<?php
namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\File;
use Doctrine\ORM\EntityManagerInterface;

final class FileDataPersister implements ContextAwareDataPersisterInterface
{
    private EntityManagerInterface $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function supports($data, array $context = []): bool
    {
        return $data instanceof File;
    }

    public function persist($data, array $context = [])
    {
        $this->entityManager->persist($data);
        $this->entityManager->flush();
    }

    public function remove($data, array $context = []): void
    {
        $this->entityManager->remove($data);
        $this->entityManager->flush();
    }
}