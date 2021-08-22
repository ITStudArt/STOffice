<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiSubresource;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\MappedSuperclass()
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"patient"="Patient","therapist"="Therapist"})
 * @ApiResource(
 *     itemOperations={
 *     "get"={
 *     "access_control"="is_granted('IS_AUTHENTICATED_FULLY')"
 *     }
 * },
 *     collectionOperations={"post"
 *     },
 *     normalizationContext={
 *     "groups" = {"read"}
 *     },
 *     denormalizationContext={
 *          "groups"={"post"}
 *     }
 * )
 * @UniqueEntity("email")
 */
class User implements UserInterface,PasswordAuthenticatedUserInterface
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
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"read"})
     * @Assert\NotBlank()
     */
    private $surname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Regex(
     *     pattern="/(?=.*[A-Z])(?=.*[A-Z])(?=.*[0-9]).{7,}/",
     *     message="Password must be 8 letters long, contain at least one digit, one uppercase letter and one lower case."
     * )
     */
    private $password;

    /**
     * @Assert\NotBlank()
     * @Assert\Expression(
     *     "this.getPassword() === this.getRetypedPassword()",
     *     message="Passwords doesn't match"
     * )
     */
    private $retypedpassword;

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
     * @ApiSubresource()
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
    public function getUsername()
    {
        return $this->email;
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

    public function getRetypedPassword()
    {
        return $this->retypedpassword;
    }

    public function setRetypedPassword($retypedpassword): void
    {
        $this->retypedpassword = $retypedpassword;
    }


}
