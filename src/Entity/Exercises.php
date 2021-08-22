<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiSubresource;
use App\Repository\ExercisesRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;
/**
 * @ORM\Entity(repositoryClass=ExercisesRepository::class)
 * @ApiResource(
 *     collectionOperations={
 *     "get",
 *     "post"={
 *              "access_control"="is_granted('ROLE_THERAPIST')"
 *          }
 *     },
 *     itemOperations={"get"},
 *
 *     denormalizationContext={
 *          "groups"={"post"}
 *     }
 * )
 * @UniqueEntity(fields={"name", "path"}, message="This file already exists")
 */
class Exercises
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Groups({"post"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Groups({"post"})
     */
    private $path;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ExercisesType")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     * @Groups({"post"})
     */
    private $type;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }

}
