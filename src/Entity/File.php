<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Repository\FileRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(formats={"json"})
 * @ApiFilter(SearchFilter::class, properties={"id": "exact","titre": "ipartial"})
 * @ORM\Entity(repositoryClass=FileRepository::class)
 */
class File
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Length(min=10,max=30,
     *      minMessage = "Le titre doit être au moins de {{ limit }} caractères",
     *      maxMessage = "Le titre doit être au maximum {{ limit }} caractères"
     *      )
     */
    private $titre;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     * @Assert\Length(min=10,
     *     minMessage = "La description doit être au moins de {{ limit }} caractères",
     *     )
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="files")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $brochureFilename;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $stateFile;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getBrochureFilename(): ?string
    {
        return $this->brochureFilename;
    }

    public function setBrochureFilename(?string $brochureFilename): self
    {
        $this->brochureFilename = $brochureFilename;

        return $this;
    }

    public function getStateFile(): ?bool
    {
        return $this->stateFile;
    }

    public function setStateFile(?bool $stateFile): self
    {
        $this->stateFile = $stateFile;

        return $this;
    }
}
