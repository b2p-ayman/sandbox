<?php

// api/src/DataProvider/AdresseItemDataProvider.php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\DataProvider\SerializerAwareDataProviderInterface;
use ApiPlatform\Core\DataProvider\SerializerAwareDataProviderTrait;
use ApiPlatform\Core\Exception\InvalidIdentifierException;
use App\Entity\Adresse;
use App\Repository\AdresseRepository;

final class AdresseItemDataProvider implements ItemDataProviderInterface, RestrictedDataProviderInterface, SerializerAwareDataProviderInterface
{
    use SerializerAwareDataProviderTrait;

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
     * @throws InvalidIdentifierException
     */
    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): ?Adresse
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
        // return $this->getSerializer()->deserialize($file, Adresse::class, 'custom');
        return $file;
    }
}
