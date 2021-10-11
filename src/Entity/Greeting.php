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
     * @var int
     */
    private $notifId;

    /**
     * @Assert\NotBlank
     */
    public ?string $message = 'Default Message';

    /**
     * @Assert\NotBlank
     */
    public ?string $user = 'Default User';

    /**
     * @Assert\NotBlank
     */
    public ?string $document = 'Default Doc';

    public function __construct(int $notifId)
    {
        $this->notifId = $notifId;
    }

    public function getNotifId(): int
    {
        return $this->notifId;
    }
}
