<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\AdresseRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=AdresseRepository::class)
 */
class Adresse
{
    use Timestampable;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $numero;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $rue;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $codePostal;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pays;

    /**
     * @ORM\OneToOne(targetEntity=Site::class, mappedBy="adressePrincipale", cascade={"persist", "remove"})
     */
    private $site;

    /**
     * @ORM\OneToOne(targetEntity=Site::class, mappedBy="adresseAccesConducteur", cascade={"persist", "remove"})
     */
    private $site2;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(?int $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getRue(): ?string
    {
        return $this->rue;
    }

    public function setRue(?string $rue): self
    {
        $this->rue = $rue;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->codePostal;
    }

    public function setCodePostal(?string $codePostal): self
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(?string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(?string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getSite(): ?Site
    {
        return $this->site;
    }

    public function setSite(?Site $site): self
    {
        // unset the owning side of the relation if necessary
        if (null === $site && null !== $this->site) {
            $this->site->setAdressePrincipale(null);
        }

        // set the owning side of the relation if necessary
        if (null !== $site && $site->getAdressePrincipale() !== $this) {
            $site->setAdressePrincipale($this);
        }

        $this->site = $site;

        return $this;
    }

    public function getSite2(): ?Site
    {
        return $this->site2;
    }

    public function setSite2(?Site $site2): self
    {
        // unset the owning side of the relation if necessary
        if (null === $site2 && null !== $this->site2) {
            $this->site2->setAdresseAccesConducteur(null);
        }

        // set the owning side of the relation if necessary
        if (null !== $site2 && $site2->getAdresseAccesConducteur() !== $this) {
            $site2->setAdresseAccesConducteur($this);
        }

        $this->site2 = $site2;

        return $this;
    }
}
