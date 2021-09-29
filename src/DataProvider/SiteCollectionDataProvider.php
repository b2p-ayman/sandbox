<?php

// api/src/DataProvider/SiteCollectionDataProvider.php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\Site;
use App\Repository\SiteRepository;

final class SiteCollectionDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{
    private SiteRepository $repository;

    public function __construct(SiteRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array<string, mixed> $context
     */
    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Site::class === $resourceClass;
    }

    /**
     * @param array<string, mixed> $context
     *
     * @throws \RuntimeException
     *
     * @return iterable<Site>
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
