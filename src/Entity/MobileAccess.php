<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MobileAccessRepository;
use App\Utils\Timestampable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=MobileAccessRepository::class)
 */
class MobileAccess
{
    use Timestampable;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $identifiant;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $langue;

    /**
     * @ORM\ManyToMany(targetEntity=HistoriqueConsultation::class, mappedBy="mobileAccess")
     */
    private $historiqueConsultations;

    /**
     * @ORM\ManyToOne(targetEntity=Contact::class, inversedBy="mobileAccesses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $contact;

    public function __construct()
    {
        $this->historiqueConsultations = new ArrayCollection();
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getIdentifiant(): ?string
    {
        return $this->identifiant;
    }

    public function setIdentifiant(?string $identifiant): self
    {
        $this->identifiant = $identifiant;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getLangue(): ?string
    {
        return $this->langue;
    }

    public function setLangue(?string $langue): self
    {
        $this->langue = $langue;

        return $this;
    }

    /**
     * @return Collection|HistoriqueConsultation[]
     */
    public function getHistoriqueConsultations(): Collection
    {
        return $this->historiqueConsultations;
    }

    public function addHistoriqueConsultation(HistoriqueConsultation $historiqueConsultation): self
    {
        if (!$this->historiqueConsultations->contains($historiqueConsultation)) {
            $this->historiqueConsultations[] = $historiqueConsultation;
            $historiqueConsultation->addMobileAccess($this);
        }

        return $this;
    }

    public function removeHistoriqueConsultation(HistoriqueConsultation $historiqueConsultation): self
    {
        if ($this->historiqueConsultations->removeElement($historiqueConsultation)) {
            $historiqueConsultation->removeMobileAccess($this);
        }

        return $this;
    }

    public function getContact(): ?Contact
    {
        return $this->contact;
    }

    public function setContact(?Contact $contact): self
    {
        $this->contact = $contact;

        return $this;
    }
}
