<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Repository\FileRepository;
use App\Utils\Timestampable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use App\Controller\FileUpdateTitle;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\NumericFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\RangeFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\ExistsFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;

/**
 * @ApiResource(
 *     formats={"json"},
 *     collectionOperations={
 *          "get"={
 *              "normalization_context"={"groups"={"file_read"}}
 *          },
 *          "post"
 *     },
 *     itemOperations={
 *         "get"={
 *             "normalization_context"={"groups"={"file_details_read"}}
 *         },
 *         "put",
 *         "patch",
 *         "delete",
 *          "put_update_title"={
 *              "method"="PUT",
 *              "path"="/files/{id}/update-title",
 *              "controller"=FileUpdateTitle::class,
 *          }
 *     },
 *     attributes={"pagination_items_per_page"=7}
 * )
 * @ApiFilter(SearchFilter::class, properties={"id": "exact","titre": "ipartial"})
 * @ApiFilter(BooleanFilter::class, properties={"stateFile"})
 * @ApiFilter(NumericFilter::class, properties={"id"})
 * @ApiFilter(RangeFilter::class, properties={"id"})
 * @ApiFilter(ExistsFilter::class, properties={"stateFile"})
 * @ApiFilter(OrderFilter::class, properties={"id"}, arguments={"orderParameterName"="order"})
 * @ORM\Entity(repositoryClass=FileRepository::class)
 */
class File
{
    use Timestampable;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"file_read", "file_details_read", "user_details_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Length(min=10,max=30,
     *      minMessage = "Le titre doit être au moins de {{ limit }} caractères",
     *      maxMessage = "Le titre doit être au maximum {{ limit }} caractères"
     *      )
     * @Groups({"file_read", "file_details_read", "user_details_read"})
     */
    private $titre;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     * @Assert\Length(min=10,
     *     minMessage = "La description doit être au moins de {{ limit }} caractères",
     *     )
     * @Groups({"file_read", "file_details_read", "user_details_read"})
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="files")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"file_details_read"})
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $brochureFilename;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Groups({"file_read", "file_details_read", "user_details_read"})
     */
    private $stateFile;

    /**
     * @var MediaObject|null
     *
     * @ORM\ManyToOne(targetEntity=MediaObject::class)
     * @ORM\JoinColumn(nullable=true)
     * @Groups({"file_read", "file_details_read", "user_details_read"})
     */
    public $document;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $language;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $version;

    /**
     * @ORM\ManyToMany(targetEntity=HistoriqueConsultation::class, mappedBy="document")
     */
    private $historiqueConsultations;

    /**
     * @ORM\OneToMany(targetEntity=HistoriqueEnvoi::class, mappedBy="document")
     */
    private $historiqueEnvois;

    /**
     * @ORM\ManyToOne(targetEntity=Site::class, inversedBy="files")
     */
    private $site;

    public function __construct()
    {
        $this->historiqueConsultations = new ArrayCollection();
        $this->historiqueEnvois = new ArrayCollection();
        $this->createdAt = new \DateTimeImmutable();
    }

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

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setLanguage(?string $language): self
    {
        $this->language = $language;

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

    public function getVersion(): ?int
    {
        return $this->version;
    }

    public function setVersion(?int $version): self
    {
        $this->version = $version;

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
            $historiqueConsultation->addDocument($this);
        }

        return $this;
    }

    public function removeHistoriqueConsultation(HistoriqueConsultation $historiqueConsultation): self
    {
        if ($this->historiqueConsultations->removeElement($historiqueConsultation)) {
            $historiqueConsultation->removeDocument($this);
        }

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
            $historiqueEnvoi->setDocument($this);
        }

        return $this;
    }

    public function removeHistoriqueEnvoi(HistoriqueEnvoi $historiqueEnvoi): self
    {
        if ($this->historiqueEnvois->removeElement($historiqueEnvoi)) {
            // set the owning side to null (unless already changed)
            if ($historiqueEnvoi->getDocument() === $this) {
                $historiqueEnvoi->setDocument(null);
            }
        }

        return $this;
    }

    public function getSite(): ?Site
    {
        return $this->site;
    }

    public function setSite(?Site $site): self
    {
        $this->site = $site;

        return $this;
    }
}
