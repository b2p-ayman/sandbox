<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     formats={"json"},
 *     output=false,
 *     messenger=true,
 *     collectionOperations={"get", "post"={"status"=202}},
 *     itemOperations={}
 *     )
 */
class Greeting
{
    /**
     * @Assert\NotBlank
     */
    public ?string $message;

    /**
     * @Assert\NotBlank
     */
    public ?int $user_id;

    /**
     * @Assert\NotBlank
     */
    public ?int $document_id;
}
