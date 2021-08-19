<?php

namespace App\DataFixtures;

use App\Entity\Exercises;
use App\Entity\ExercisesType;
use App\Entity\Patient;
use App\Entity\Therapist;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    /**
     * @var UserPasswordHasherInterface
     */
    private $passwordHasher;


    public function __construct(UserPasswordHasherInterface $passwordHash)
    {
        $this->passwordHasher = $passwordHash;

    }
    public function load(ObjectManager $manager)
    {
        $this->loadExercisesTypes($manager);
        $this->loadExercises($manager);
        $this->loadPatients($manager);
        $this->loadTherapist($manager);
    }
    public function loadExercisesTypes(ObjectManager $manager)
    {
        $exercise_type = new ExercisesType();
        $exercise_type->setType('doc_type');
        $exercise_type->setIcon('doc_icon');
        $this->setReference('doc_type',$exercise_type);
        $manager->persist($exercise_type);

        $exercise_type = new ExercisesType();
        $exercise_type->setType('txt_type');
        $exercise_type->setIcon('txt_icon');
        $this->setReference('txt_type',$exercise_type);
        $manager->persist($exercise_type);

        $manager->flush();
    }
    public function loadExercises(ObjectManager $manager)
    {
        $exercise = new Exercises();
        $exercise->setName('Exercise 1');
        $exercise->setPath('exercise_1_path');
        $exercise->setType($this->getReference('doc_type'));
        $manager->persist($exercise);

        $exercise = new Exercises();
        $exercise->setName('Exercise 2');
        $exercise->setPath('exercise_2_path');
        $exercise->setType($this->getReference('txt_type'));
        $manager->persist($exercise);

        $manager->flush();

    }
    public function loadPatients(ObjectManager $manager)
    {
        $user = new User();
        $user ->setName('user_patient');
        $user->setSurname('user_patient_surname');
        $user->setEmail('email@email.com');
        $user->setPassword($this->passwordHasher->hashPassword($user,'admin123'));
        $user->setPhone('111222333');
        $user->setPhoto('example_photo_path_there');
        $this->addReference('user_patient_1',$user);
        $manager->persist($user);
        $patient = new Patient();
        $patient->setParentName('parent_name');
        $patient->setParentSurname('parent_surname');
        $patient->setTherapist('therapist_name');
        $patient->setAge('18');
        $this->addReference('patient_1',$patient);
        $patient->setId($this->getReference('user_patient_1'));
        $manager->persist($patient);
        $manager->flush();

    }
    public function loadTherapist(ObjectManager $manager)
    {
        $user = new User();
        $user ->setName('user_Therapist');
        $user->setSurname('user_Therapist_surname');
        $user->setEmail('Therapist@email.com');
        $user->setPassword($this->passwordHasher->hashPassword($user,'admin123'));
        $user->setPhone('111222333');
        $user->setPhoto('example_photo_path_there');
        $this->addReference('user_therapist_1',$user);
        $manager->persist($user);
        $therapist = new Therapist();
        $therapist->setId($this->getReference('user_therapist_1'));
        $therapist->setAccountNumber('1111222233334444');
        $therapist->setHourlyRate('20');
        $therapist->setSpecialization('therapist_specialization');
        $this->addReference('therapist_1',$therapist);
        $manager->persist($therapist);
        $manager->flush();
    }
    public function loadUsersExercises(ObjectManager $manager)
    {
        $therapist = $this->getReference('user_therapist_1');
    }

}
