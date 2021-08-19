<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\MappedSuperclass()
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"patient"="Patient","therapist"="Therapist"})
 * @ApiResource(
 *     itemOperations={"get"},
 *     collectionOperations={"post"},
 *     normalizationContext={
 *     "groups" = {"read"}
 *     }
 * )
 */
class User implements PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"read"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"read"})
     */
    private $surname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=20)
     * @Groups({"read"})
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"read"})
     */
    private $photo;

    /**
     * Many Users have Many Exercises.
     * @ORM\ManyToMany(targetEntity="App\Entity\Exercises",cascade={"persist"})
     * @ORM\JoinTable(name="users_exercises",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="exercise_id", referencedColumnName="id")}
     *      )
     * @Groups({"read"})
     */
    private $exercies;

    public function __construct(){
        $this->exercies = new ArrayCollection();
    }

    public function getExercies()
    {
        return $this->exercies;
    }

    /**
     * @param Exercises $exercies
     */
    public function setExercies(Exercises $exercie): void
    {
        if(!$this->exercies->contains($exercie))
            $this->exercies[] = $exercie;
    }

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

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }
    public function getRoles()
    {
        return ['ROLE_USER'];
    }
    public function getSalt()
    {
        return null;
    }
    public function eraseCredentials()
    {
        return null;
    }


}
