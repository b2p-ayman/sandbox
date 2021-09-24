<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\HistoriqueConsultationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=HistoriqueConsultationRepository::class)
 */
class HistoriqueConsultation
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
    private $timeConsultation;

    /**
     * @ORM\ManyToMany(targetEntity=File::class, inversedBy="historiqueConsultations")
     */
    private $document;

    /**
     * @ORM\ManyToMany(targetEntity=MobileAccess::class, inversedBy="historiqueConsultations")
     */
    private $mobileAccess;

    public function __construct()
    {
        $this->document = new ArrayCollection();
        $this->mobileAccess = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTimeConsultation(): ?string
    {
        return $this->timeConsultation;
    }

    public function setTimeConsultation(?string $timeConsultation): self
    {
        $this->timeConsultation = $timeConsultation;

        return $this;
    }

    /**
     * @return Collection|File[]
     */
    public function getDocument(): Collection
    {
        return $this->document;
    }

    public function addDocument(File $document): self
    {
        if (!$this->document->contains($document)) {
            $this->document[] = $document;
        }

        return $this;
    }

    public function removeDocument(File $document): self
    {
        $this->document->removeElement($document);

        return $this;
    }

    /**
     * @return Collection|MobileAccess[]
     */
    public function getMobileAccess(): Collection
    {
        return $this->mobileAccess;
    }

    public function addMobileAccess(MobileAccess $mobileAccess): self
    {
        if (!$this->mobileAccess->contains($mobileAccess)) {
            $this->mobileAccess[] = $mobileAccess;
        }

        return $this;
    }

    public function removeMobileAccess(MobileAccess $mobileAccess): self
    {
        $this->mobileAccess->removeElement($mobileAccess);

        return $this;
    }
}
