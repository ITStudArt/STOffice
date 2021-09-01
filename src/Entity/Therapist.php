<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiSubresource;
use App\Repository\TherapistRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\PersistentCollection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * @ORM\Entity(repositoryClass=TherapistRepository::class)
 * @ApiFilter(
 *      SearchFilter::class,
 *      properties={
 *              "id.name": "partial"
 *     }
 *     )
 * @ApiResource(
 *     denormalizationContext={
 *         "groups"={"post-with-user"}
 *     },
 *     normalizationContext={"groups"={"post-with-user"}}
 * )
 */
class Therapist
{
    /**
     * @ORM\Id
     * @ORM\OneToOne(targetEntity="User")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     * @Groups({"post-with-user"})
     * @ApiSubresource
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"post-with-user"})
     */
    private $specialization;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Groups({"post-with-user"})
     */
    private $account_number;

    /**
     * @ORM\Column(type="string", length=10)
     * @Groups({"post-with-user"})
     */
    private $hourly_rate;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Patient", mappedBy="id")
     * @ORM\JoinColumn(nullable=true,onDelete="CASCADE")
     * @Groups({"post-with-user"})
     */
    private $therapist_patients;

    public function __construct()
    {
        $this->therapist_patients = new PersistentCollection();
    }

    /**
     * @return PersistentCollection
     */
    public function getTherapistPatients(): PersistentCollection
    {
        return $this->therapist_patients;
    }


    public function getId(): ?User
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getSpecialization(): ?string
    {
        return $this->specialization;
    }

    public function setSpecialization(string $specialization): self
    {
        $this->specialization = $specialization;

        return $this;
    }

    public function getAccountNumber(): ?string
    {
        return $this->account_number;
    }

    public function setAccountNumber(?string $account_number)
    {
        $this->account_number = $account_number;
    }

    public function getHourlyRate(): ?string
    {
        return $this->hourly_rate;
    }

    public function setHourlyRate(string $hourly_rate): self
    {
        $this->hourly_rate = $hourly_rate;

        return $this;
    }
}
