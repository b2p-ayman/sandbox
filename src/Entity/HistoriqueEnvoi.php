<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\HistoriqueEnvoiRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=HistoriqueEnvoiRepository::class)
 */
class HistoriqueEnvoi
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity=File::class, inversedBy="historiqueEnvois")
     */
    private $document;

    /**
     * @ORM\ManyToOne(targetEntity=Contact::class, inversedBy="historiqueEnvois")
     */
    private $expediteur;

    /**
     * @ORM\ManyToOne(targetEntity=Contact::class, inversedBy="historiqueEnvois")
     */
    private $destinataire;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getDocument(): ?File
    {
        return $this->document;
    }

    public function setDocument(?File $document): self
    {
        $this->document = $document;

        return $this;
    }

    public function getExpediteur(): ?Contact
    {
        return $this->expediteur;
    }

    public function setExpediteur(?Contact $expediteur): self
    {
        $this->expediteur = $expediteur;

        return $this;
    }

    public function getDestinataire(): ?Contact
    {
        return $this->destinataire;
    }

    public function setDestinataire(?Contact $destinataire): self
    {
        $this->destinataire = $destinataire;

        return $this;
    }
}
