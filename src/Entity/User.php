<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiSubresource;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use App\Controller\ResetPasswordAction;
use App\Entity\Exercises;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
// 37 linie "get":  *          "access_control"="is_granted('IS_AUTHENTICATED_FULLY')",
/**
 * @ORM\MappedSuperclass()
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"patient"="Patient","therapist"="Therapist"})
 * @ApiFilter(
 *      SearchFilter::class,
 *      properties={
 *              "roles": "exact",
 *              "email": "exact"
 *     }
 *     )
 * @ApiResource(
 *     itemOperations={
 *     "get"={
 *              "access_control"="is_granted('IS_AUTHENTICATED_FULLY')",
 *              "normalization_context"={
 *                 "groups"={"get-user-exercises"}
 *
 *              }
 *     },
 *     "put"={
 *             "access_control"="is_granted('IS_AUTHENTICATED_FULLY') and object == user"
 *         },
 *     "put-reset-password"={
 *           "access_control"="is_granted('IS_AUTHENTICATED_FULLY') and object == user",
 *           "method"="PUT",
 *           "path"="/users/{id}/reset-password",
 *           "controller"=ResetPasswordAction::class,
 *           "denormalization_context"={
 *                  "groups"={"put-reset-password"}
 *              }
 *     }
 * },
 *     collectionOperations={
 *     "get"={
 *     "access_control"="is_granted('ROLE_THERAPIST')"
 *     },
 *     "post"={
 *               "access_control"="is_granted('ROLE_THERAPIST')",
 *               "denormalization_context"={
 *                  "groups"={"post"}
 *                },
 *               "normalization_context"={
 *                  "groups" = {"get"}
 *                }
 *          },
 *     "post-exercise"={
 *              "access_control"="is_granted('IS_AUTHENTICATED_FULLY') and object == user"
 *          }
 *     }
 * )
 * @UniqueEntity("email")
 */
/*
 *  *     "put"={
 *              "denormalization_context"={
 *                 "groups"={"put"}
 *             },
 *             "normalization_context"={
 *                 "groups"={"get"}
 *             }
 *     }
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    const ROLE_THERAPIST = 'ROLE_THERAPIST';
    const ROLE_PATIENT = 'ROLE_PATIENT';
    const ROLE_DEF_USER = 'ROLE_DEF_USER';
    const ROLE_ADMIN = 'ROLE_ADMIN';
    const ROLE_SUPERADMIN = 'ROLE_SUPERADMIN';
    const DEFAULT_ROLES = [self::ROLE_PATIENT];
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"get","get-user-exercises"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"get","post","put","get-user-exercises","post-with-user"})
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"get","post","put","get-user-exercises","post-with-user"})
     * @Assert\NotBlank()
     */
    private $surname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email()
     * @Assert\NotBlank()
     * @Groups({"get-owner","get-admin","post","put","get-user-exercises","post-with-user"})
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"get-admin","post","post-with-user"})
     * @Assert\NotBlank()
     * @Assert\Regex(
     *     pattern="/(?=.*[A-Z])(?=.*[A-Z])(?=.*[0-9]).{7,}/",
     *     message="Password must be 8 letters long, contain at least one digit, one uppercase letter and one lower case."
     * )
     */
    private $password;

    /**
     * @Groups({"post","post-with-user"})
     * @Assert\NotBlank(groups={"put"})
     * @Assert\Expression(
     *     "this.getPassword() === this.getRetypedPassword()",
     *     message="Passwords doesn't match",
     *     groups={"post"}
     * )
     */
    private $retypedpassword;

    /**
     * @Groups({"put-reset-password"})
     * @Assert\NotBlank(groups={"put-reset-password"})
     * @Assert\Regex(
     *     pattern="/(?=.*[A-Z])(?=.*[A-Z])(?=.*[0-9]).{7,}/",
     *     message="Password must be 8 letters long, contain at least one digit, one uppercase letter and one lower case.",
     *     groups={"post"}
     * )
     */
    private $newPassword;

    /**
     * @Groups({"put-reset-password"})
     * @Assert\NotBlank(groups={"put-reset-password"})
     * @Assert\Expression(
     *     "this.getNewPassword() === this.getNewRetypedPassword()",
     *     message="Passwords doesn't match"
     * )
     */
    private $newRetypedPassword;
    /**
     * @Groups({"put-reset-password"})
     * @Assert\NotBlank(groups={"put-reset-password"})
     * @UserPassword(groups={"put-reset-password"})
     */
    private $oldPassword;

    /**
     * @ORM\Column(type="string", length=20)
     * @Groups({"get","post","put","get-user-exercises","post-with-user"})
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"get","post","put","get-user-exercises","post-with-user"})
     */
    private $photo;
/*
 *      * @ORM\JoinTable(name="users_exercises",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="CASCADE")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="exercise_id", referencedColumnName="id", onDelete="CASCADE")}
     *      )
 */
    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Exercises")
     * @ORM\JoinTable()
     * @ApiSubresource()
     * @Groups({"put","post","post-exercise","get-user-exercises","post-with-user"})
     */
    private $exercises;

    /**
     * @ORM\Column(type="simple_array", length=200)
     * @Groups({"get-owner","get-admin","post","post-with-user"})
     */
    private $roles;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $passwordChangeDate;

    public function __construct()
    {
        $this->exercises = new ArrayCollection();
        $this->roles = self::DEFAULT_ROLES;
    }

    public function getExercises()
    {
        return $this->exercises;
    }
    public function addExercise(\App\Entity\Exercises $exercies)
    {
        $this->exercises->add($exercies);
        return $this;
    }
    public function removeExercises(Exercises $exercises)
    {
        $this->exercises->removeElement($exercises);
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

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function setRoles(array $roles)
    {
        $this->roles = $roles;
    }

    public function addRole($role)
    {
        if (!$this->roles->contains($role))
            $this->roles[] = $role;
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

    public function getNewPassword():?string
    {
        return $this->newPassword;
    }


    public function setNewPassword($newPassword): void
    {
        $this->newPassword = $newPassword;
    }


    public function getNewRetypedPassword():?string
    {
        return $this->newRetypedPassword;
    }

    public function setNewRetypedPassword($newRetypedPassword): void
    {
        $this->newRetypedPassword = $newRetypedPassword;
    }

    public function getOldPassword():?string
    {
        return $this->oldPassword;
    }

    public function setOldPassword($oldPassword): void
    {
        $this->oldPassword = $oldPassword;
    }

    public function getPasswordChangeDate()
    {
        return $this->passwordChangeDate;
    }

    public function setPasswordChangeDate($passwordChangeDate): void
    {
        $this->passwordChangeDate = $passwordChangeDate;
    }



}
