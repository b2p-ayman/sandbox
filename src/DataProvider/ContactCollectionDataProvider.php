<?php

// api/src/DataProvider/ContactCollectionDataProvider.php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\Contact;
use App\Repository\ContactRepository;

final class ContactCollectionDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{
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
     *
     * @throws \RuntimeException
     *
     * @return iterable<Contact>
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
