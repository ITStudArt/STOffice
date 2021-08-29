<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiSubresource;
use App\Repository\ExercisesRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use App\Controller\UploadExercisesAction;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;

/**
 * @ORM\Entity(repositoryClass=ExercisesRepository::class)
 * @ApiFilter(
 *      SearchFilter::class,
 *      properties={
 *              "id": "exact",
 *              "name": "partial"
 *     }
 *     )
 * @ApiFilter(
 *     OrderFilter::class,
 *     properties={
 *          "id",
 *          "name"
 *     },
 *     arguments={"orderParameterName"="_order"}
 * )
 * @ApiResource(
 *     attributes={
 *              "order"={"name":"ASC"}
 *     },
 *     collectionOperations={
 *     "get",
 *     "post-exercise"={
 *              "method"="POST",
 *              "url"="/exercises",
 *              "controller"=UploadExercisesAction::class,
 *              "defaults" = {"_api_receive"=false},
 *          }
 *     },
 *     itemOperations={
 *          "get"
 *     }
 * )
 * @UniqueEntity(fields={"name"}, message="This file already exists")
 * @Vich\Uploadable()
 */
class Exercises
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"get-user-exercises"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"get-user-exercises"})
     */
    private $name;

    /**
     * @ORM\Column(nullable=true)
     * @Groups({"get-user-exercises"})
     */
    private $url;

    /**
     * @Vich\UploadableField(mapping="exercisesFiles",fileNameProperty="url")
     * @Assert\NotNull()
     */
    private $file;
//    /**
//     * @ORM\ManyToOne(targetEntity="App\Entity\ExercisesType")
//     * @ORM\JoinColumn(name="type_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
//     * @Groups({"post"})
//     */
//    private $type;

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

    public function getUrl(): ?string
    {
        return '/exercises_files/'.$this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

//    public function getType()
//    {
//        return $this->type;
//    }
//
//    public function setType($type): void
//    {
//        $this->type = $type;
//    }

    public function getFile()
    {
        return $this->file;
    }

    public function setFile($file): void
    {
        $this->file = $file;
    }


}
