<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\SiteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=SiteRepository::class)
 */
class Site
{
    use Timestampable;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $coordGPS;

    /**
     * @ORM\OneToMany(targetEntity=File::class, mappedBy="site")
     */
    private $files;

    /**
     * @ORM\OneToOne(targetEntity=Adresse::class, inversedBy="site", cascade={"persist", "remove"})
     */
    private $adressePrincipale;

    /**
     * @ORM\OneToOne(targetEntity=Adresse::class, inversedBy="site2", cascade={"persist", "remove"})
     */
    private $adresseAccesConducteur;

    /**
     * @ORM\ManyToMany(targetEntity=Contact::class, inversedBy="sitesContactUrgence")
     */
    private $contactUrgence;

    /**
     * @ORM\OneToMany(targetEntity=Contact::class, mappedBy="siteResponsible")
     */
    private $contacts;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    public function __construct()
    {
        $this->files = new ArrayCollection();
        $this->contactUrgence = new ArrayCollection();
        $this->createdAt = new \DateTimeImmutable();
        $this->contacts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCoordGPS(): ?string
    {
        return $this->coordGPS;
    }

    public function setCoordGPS(?string $coordGPS): self
    {
        $this->coordGPS = $coordGPS;

        return $this;
    }

    /**
     * @return Collection|File[]
     */
    public function getFiles(): Collection
    {
        return $this->files;
    }

    public function addFile(File $file): self
    {
        if (!$this->files->contains($file)) {
            $this->files[] = $file;
            $file->setSite($this);
        }

        return $this;
    }

    public function removeFile(File $file): self
    {
        if ($this->files->removeElement($file)) {
            // set the owning side to null (unless already changed)
            if ($file->getSite() === $this) {
                $file->setSite(null);
            }
        }

        return $this;
    }

    public function getAdressePrincipale(): ?Adresse
    {
        return $this->adressePrincipale;
    }

    public function setAdressePrincipale(?Adresse $adressePrincipale): self
    {
        $this->adressePrincipale = $adressePrincipale;

        return $this;
    }

    public function getAdresseAccesConducteur(): ?Adresse
    {
        return $this->adresseAccesConducteur;
    }

    public function setAdresseAccesConducteur(?Adresse $adresseAccesConducteur): self
    {
        $this->adresseAccesConducteur = $adresseAccesConducteur;

        return $this;
    }

    /**
     * @return Collection|Contact[]
     */
    public function getContactUrgence(): Collection
    {
        return $this->contactUrgence;
    }

    public function addContactUrgence(Contact $contactUrgence): self
    {
        if (!$this->contactUrgence->contains($contactUrgence)) {
            $this->contactUrgence[] = $contactUrgence;
        }

        return $this;
    }

    public function removeContactUrgence(Contact $contactUrgence): self
    {
        $this->contactUrgence->removeElement($contactUrgence);

        return $this;
    }

    /**
     * @return Collection|Contact[]
     */
    public function getContacts(): Collection
    {
        return $this->contacts;
    }

    public function addContact(Contact $contact): self
    {
        if (!$this->contacts->contains($contact)) {
            $this->contacts[] = $contact;
            $contact->setSiteResponsible($this);
        }

        return $this;
    }

    public function removeContact(Contact $contact): self
    {
        if ($this->contacts->removeElement($contact)) {
            // set the owning side to null (unless already changed)
            if ($contact->getSiteResponsible() === $this) {
                $contact->setSiteResponsible(null);
            }
        }

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
