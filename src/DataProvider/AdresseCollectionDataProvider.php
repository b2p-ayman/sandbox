<?php

// api/src/DataProvider/AdresseCollectionDataProvider.php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\Adresse;
use App\Repository\AdresseRepository;

final class AdresseCollectionDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{
    private AdresseRepository $repository;

    public function __construct(AdresseRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array<string, mixed> $context
     */
    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Adresse::class === $resourceClass;
    }

    /**
     * @param array<string, mixed> $context
     *
     * @throws \RuntimeException
     *
     * @return iterable<Adresse>
     */
    public function getCollection(string $resourceClass, string $operationName = null, array $context = []): iterable
    {
        try {
            $collection = $this->repository->findAll();
        } catch (\Exception $e) {
            throw new \RuntimeException(sprintf('Unable to retrieve datas from external source: %s', $e->getMessage()));
        }

        return $collection ?? null;
    }
}
