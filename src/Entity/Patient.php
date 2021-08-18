<?php

namespace App\Entity;


use App\Repository\PatientRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PatientRepository::class)
 */
class Patient
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
    private $therapist;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $parent_name;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $parent_surname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $diagnosis_files;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $age;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTherapist(): ?string
    {
        return $this->therapist;
    }

    public function setTherapist(string $therapist): self
    {
        $this->therapist = $therapist;

        return $this;
    }

    public function getParentName(): ?string
    {
        return $this->parent_name;
    }

    public function setParentName(string $parent_name): self
    {
        $this->parent_name = $parent_name;

        return $this;
    }

    public function getParentSurname(): ?string
    {
        return $this->parent_surname;
    }

    public function setParentSurname(string $parent_surname): self
    {
        $this->parent_surname = $parent_surname;

        return $this;
    }

    public function getDiagnosisFiles(): ?string
    {
        return $this->diagnosis_files;
    }

    public function setDiagnosisFiles(?string $diagnosis_files): self
    {
        $this->diagnosis_files = $diagnosis_files;

        return $this;
    }

    public function getAge(): ?string
    {
        return $this->age;
    }

    public function setAge(string $age): self
    {
        $this->age = $age;

        return $this;
    }
}
