<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ContactRepository;
use App\Utils\Timestampable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=ContactRepository::class)
 */
class Contact
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
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity=HistoriqueEnvoi::class, mappedBy="expediteur")
     */
    private $historiqueEnvois;

    /**
     * @ORM\ManyToMany(targetEntity=Site::class, mappedBy="contactUrgence")
     */
    private $sitesContactUrgence;

    /**
     * @ORM\OneToMany(targetEntity=MobileAccess::class, mappedBy="contact")
     */
    private $mobileAccesses;

    /**
     * @ORM\ManyToOne(targetEntity=Site::class, inversedBy="contacts")
     */
    private $siteResponsible;

    /**
     * @ORM\OneToOne(targetEntity=User::class, mappedBy="contact", cascade={"persist", "remove"})
     */
    private $user;

    public function __construct()
    {
        $this->historiqueEnvois = new ArrayCollection();
        $this->sitesContactUrgence = new ArrayCollection();
        $this->createdAt = new \DateTimeImmutable();
        $this->mobileAccesses = new ArrayCollection();
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|HistoriqueEnvoi[]
     */
    public function getHistoriqueEnvois(): Collection
    {
        return $this->historiqueEnvois;
    }

    public function addHistoriqueEnvoi(HistoriqueEnvoi $historiqueEnvoi): self
    {
        if (!$this->historiqueEnvois->contains($historiqueEnvoi)) {
            $this->historiqueEnvois[] = $historiqueEnvoi;
            $historiqueEnvoi->setExpediteur($this);
        }

        return $this;
    }

    public function removeHistoriqueEnvoi(HistoriqueEnvoi $historiqueEnvoi): self
    {
        if ($this->historiqueEnvois->removeElement($historiqueEnvoi)) {
            // set the owning side to null (unless already changed)
            if ($historiqueEnvoi->getExpediteur() === $this) {
                $historiqueEnvoi->setExpediteur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Site[]
     */
    public function getSitesContactUrgence(): Collection
    {
        return $this->sitesContactUrgence;
    }

    public function addSitesContactUrgence(Site $sitesContactUrgence): self
    {
        if (!$this->sitesContactUrgence->contains($sitesContactUrgence)) {
            $this->sitesContactUrgence[] = $sitesContactUrgence;
            $sitesContactUrgence->addContactUrgence($this);
        }

        return $this;
    }

    public function removeSitesContactUrgence(Site $sitesContactUrgence): self
    {
        if ($this->sitesContactUrgence->removeElement($sitesContactUrgence)) {
            $sitesContactUrgence->removeContactUrgence($this);
        }

        return $this;
    }

    /**
     * @return Collection|MobileAccess[]
     */
    public function getMobileAccesses(): Collection
    {
        return $this->mobileAccesses;
    }

    public function addMobileAccess(MobileAccess $mobileAccess): self
    {
        if (!$this->mobileAccesses->contains($mobileAccess)) {
            $this->mobileAccesses[] = $mobileAccess;
            $mobileAccess->setContact($this);
        }

        return $this;
    }

    public function removeMobileAccess(MobileAccess $mobileAccess): self
    {
        if ($this->mobileAccesses->removeElement($mobileAccess)) {
            // set the owning side to null (unless already changed)
            if ($mobileAccess->getContact() === $this) {
                $mobileAccess->setContact(null);
            }
        }

        return $this;
    }

    public function getSiteResponsible(): ?Site
    {
        return $this->siteResponsible;
    }

    public function setSiteResponsible(?Site $siteResponsible): self
    {
        $this->siteResponsible = $siteResponsible;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        // unset the owning side of the relation if necessary
        if (null === $user && null !== $this->user) {
            $this->user->setContact(null);
        }

        // set the owning side of the relation if necessary
        if (null !== $user && $user->getContact() !== $this) {
            $user->setContact($this);
        }

        $this->user = $user;

        return $this;
    }
}
