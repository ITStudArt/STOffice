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
use Faker;
class AppFixtures extends Fixture
{
    /**
     * @var UserPasswordHasherInterface
     */
    private $passwordHasher;
    /**
     * @var Faker\Factory
     */
    private $faker;


    public function __construct(UserPasswordHasherInterface $passwordHash)
    {
        $this->passwordHasher = $passwordHash;
        $this->faker = Faker\Factory::create();

    }
    public function load(ObjectManager $manager)
    {
        $this->loadExercisesTypes($manager);
        $this->loadExercises($manager);
        $this->loadTherapist($manager);
        $this->loadPatients($manager);

    }
    public function loadExercisesTypes(ObjectManager $manager)
    {
        $exercise_type = new ExercisesType();
        $var = $this->faker->unique()->fileExtension;
        $exercise_type->setType($var);
        $exercise_type->setIcon("$var icon");
        $this->setReference('1st_type',$exercise_type);
        $manager->persist($exercise_type);

        $exercise_type = new ExercisesType();
        $var = $this->faker->unique()->fileExtension;
        $exercise_type->setType($var);
        $exercise_type->setIcon("$var icon");
        $this->setReference('2nd_type',$exercise_type);
        $manager->persist($exercise_type);

        $manager->flush();
    }
    public function loadExercises(ObjectManager $manager)
    {
        $exercise = new Exercises();
        $exercise->setName('Exercise 1');
        $exercise->setPath('exercise_1_path');
        $exercise->setType($this->getReference('1st_type'));
        $manager->persist($exercise);

        $exercise = new Exercises();
        $exercise->setName('Exercise 2');
        $exercise->setPath('exercise_2_path');
        $exercise->setType($this->getReference('2nd_type'));
        $manager->persist($exercise);

        $manager->flush();

    }
    public function loadPatients(ObjectManager $manager)
    {
        $user = new User();
        $user->setName($this->faker->firstName);
        $user->setSurname($this->faker->lastName);
        $user->setEmail($this->faker->email);
        $user->setPassword($this->passwordHasher->hashPassword($user,'admin123'));
        $user->setPhone($this->faker->phoneNumber);
        $user->setPhoto('example_photo_path_there');
        $this->addReference('user_patient_1',$user);
        $manager->persist($user);
        $patient = new Patient();
        $patient->setParentName($this->faker->firstName);
        $patient->setParentSurname($this->faker->lastName);
        $patient->setTherapistId($this->getReference('therapist_1'));
        $patient->setAge('15');
        $this->addReference('patient_1',$patient);
        $patient->setId($this->getReference('user_patient_1'));
        $manager->persist($patient);
        $manager->flush();

    }
    public function loadTherapist(ObjectManager $manager)
    {
        $user = new User();
        $user->setName($this->faker->firstName);
        $user->setSurname($this->faker->lastName);
        $user->setEmail($this->faker->email);
        $user->setPassword($this->passwordHasher->hashPassword($user,'admin123'));
        $user->setPhone($this->faker->phoneNumber);
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
    public function loadTherapistPatient(ObjectManager $manager)
    {
        $therapist = $this->getReference('therapist_1');
        $patient = $this->getReference('patient_1');
    }
    public function loadUsersExercises(ObjectManager $manager)
    {
        $therapist = $this->getReference('patient_1');
    }

}
