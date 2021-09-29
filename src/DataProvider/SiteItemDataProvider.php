<?php

// api/src/DataProvider/SiteItemDataProvider.php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\DataProvider\SerializerAwareDataProviderInterface;
use ApiPlatform\Core\DataProvider\SerializerAwareDataProviderTrait;
use ApiPlatform\Core\Exception\InvalidIdentifierException;
use App\Entity\Site;
use App\Repository\SiteRepository;

final class SiteItemDataProvider implements ItemDataProviderInterface, RestrictedDataProviderInterface, SerializerAwareDataProviderInterface
{
    use SerializerAwareDataProviderTrait;

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
     * @throws InvalidIdentifierException
     *
     * @phpstan-ignore-next-line
     */
    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): ?Site
    {
        if (!is_int($id)) {
            throw new InvalidIdentifierException('Invalid id key type.');
        }

        try {
            $file = $this->repository->find($id);
        } catch (\Exception $e) {
            throw new \RuntimeException(sprintf('Unable to retrieve the data from external source: %s', $e->getMessage()));
        }

        // Deserialize data using the Serializer
        return $this->getSerializer()->deserialize($file, Site::class, 'custom');
    }
}
