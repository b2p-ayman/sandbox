<?php
namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\Site;
use Doctrine\ORM\EntityManagerInterface;

final class SiteDataPersister implements ContextAwareDataPersisterInterface
{
    private EntityManagerInterface $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function supports($data, array $context = []): bool
    {
        return $data instanceof Site;
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