<?php

namespace App\Entity;

use App\Repository\ExercisesTypeRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ExercisesTypeRepository::class)
 * @ApiResource(
 *     itemOperations={"get"},
 *     collectionOperations={
 *          "get",
 *          "post"={"access_control"="is_granted('IS_AUTHENITCATED_FULLY')"}
 *     },
 *     subresourceOperations={
 *          "api_users_exercies_get_subresource" = {
 *                 "method" = "get",
 *                 "normalizationContext"={
 *                  "groups" = {"read_type"}
 *                  }
 *          }
 *     },
 *     denormalizationContext={
 *          "groups"={"post"}
 *     }
 * )
 */
class ExercisesType
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
     * @Groups({"read_type"})
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank()
     * @Groups({"read_type"})
     */
    private $icon;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(?string $icon): self
    {
        $this->icon = $icon;

        return $this;
    }
}
