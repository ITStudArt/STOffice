<?php

namespace App\Entity;

use App\Repository\TherapistRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=TherapistRepository::class)
 * @ApiResource()
 */
class Therapist
{
    /**
     * @ORM\Id
     * @ORM\OneToOne(targetEntity="User")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $specialization;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $account_number;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $hourly_rate;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Patient", mappedBy="id")
     * @ORM\JoinColumn(nullable=true)
     */
    private $therapist_patients;

    public function __construct()
    {
        $this->therapist_patients = new ArrayCollection();
    }

    /**
     * @return ArrayCollection
     */
    public function getTherapistPatients(): ArrayCollection
    {
        return $this->therapist_patients;
    }


    public function getId(): ?int
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
