<?php

// api/src/DataProvider/ContactItemDataProvider.php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\DataProvider\SerializerAwareDataProviderInterface;
use ApiPlatform\Core\DataProvider\SerializerAwareDataProviderTrait;
use ApiPlatform\Core\Exception\InvalidIdentifierException;
use App\Entity\Contact;
use App\Repository\ContactRepository;

final class ContactItemDataProvider implements ItemDataProviderInterface, RestrictedDataProviderInterface, SerializerAwareDataProviderInterface
{
    use SerializerAwareDataProviderTrait;

    private ContactRepository $repository;

    public function __construct(ContactRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array<string, mixed> $context
     */
    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Contact::class === $resourceClass;
    }

    /**
     * @param array<string, mixed> $context
     * @throws InvalidIdentifierException
     */
    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): ?Contact
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
