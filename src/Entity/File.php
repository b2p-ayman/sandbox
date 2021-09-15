<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Repository\FileRepository;
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
