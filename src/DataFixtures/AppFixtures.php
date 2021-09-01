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
        $exercise->setUrl("someurl");
        $this->setReference('1st_type_ex',$exercise);
        $manager->persist($exercise);

        $exercise = new Exercises();
        $exercise->setName('Exercise 2');
        $exercise->setUrl("someurl2");
        $this->setReference('2nd_type_ex',$exercise);
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
        $user->addExercises($this->getReference('1st_type_ex'));
        $user->setRoles([User::ROLE_PATIENT]);
        $manager->persist($user);
        $patient = new Patient();
        $patient->setParentName($this->faker->firstName);
        $patient->setParentSurname($this->faker->lastName);
        $patient->setTherapistId($this->getReference('therapist_1'));
        $patient->setAge('15');
        $this->addReference('patient_1',$patient);
        $patient->setId($this->getReference('user_patient_1'));
        $manager->persist($patient);

        $user = new User();
        $user->setName($this->faker->firstName);
        $user->setSurname($this->faker->lastName);
        $user->setEmail($this->faker->email);
        $user->setPassword($this->passwordHasher->hashPassword($user,'admin123'));
        $user->setPhone($this->faker->phoneNumber);
        $user->setPhoto('example_photo_path2_there');
        $this->addReference('user_patient_2',$user);
        $user->addExercises($this->getReference('1st_type_ex'));
        $user->setRoles([User::ROLE_PATIENT]);
        $manager->persist($user);
        $patient = new Patient();
        $patient->setParentName($this->faker->firstName);
        $patient->setParentSurname($this->faker->lastName);
        $patient->setTherapistId($this->getReference('therapist_2'));
        $patient->setAge('14');
        $this->addReference('patient_2',$patient);
        $patient->setId($this->getReference('user_patient_2'));
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
        $user->setPhoto('super_admin');
        $user->setRoles([User::ROLE_SUPERADMIN]);
        $manager->persist($user);

        $user = new User();
        $user->setName($this->faker->firstName);
        $user->setSurname($this->faker->lastName);
        $user->setEmail($this->faker->email);
        $user->setPassword($this->passwordHasher->hashPassword($user,'admin123'));
        $user->setPhone($this->faker->phoneNumber);
        $user->setPhoto('example_photo_path_there');
        $user->addExercises($this->getReference('1st_type_ex'));
        $user->addExercises($this->getReference('2nd_type_ex'));
        $user->setRoles([User::ROLE_THERAPIST]);
        $this->addReference('user_therapist_1',$user);
        $manager->persist($user);
        $therapist = new Therapist();
        $therapist->setId($this->getReference('user_therapist_1'));
        $therapist->setAccountNumber('1111222233334444');
        $therapist->setHourlyRate('20');
        $therapist->setSpecialization('therapist_specialization');
        $this->addReference('therapist_1',$therapist);
        $manager->persist($therapist);

        $user = new User();
        $user->setName($this->faker->firstName);
        $user->setSurname($this->faker->lastName);
        $user->setEmail($this->faker->email);
        $user->setPassword($this->passwordHasher->hashPassword($user,'admin123'));
        $user->setPhone($this->faker->phoneNumber);
        $user->setPhoto('example_photo_path123_there');
        $user->addExercises($this->getReference('1st_type_ex'));
        $this->addReference('user_therapist_2',$user);
        $user->setRoles([User::ROLE_THERAPIST,USER::ROLE_ADMIN]);
        $manager->persist($user);
        $therapist = new Therapist();
        $therapist->setId($this->getReference('user_therapist_2'));
        $therapist->setAccountNumber('1111222233334444');
        $therapist->setHourlyRate('16');
        $therapist->setSpecialization('therapist_specialization2');
        $this->addReference('therapist_2',$therapist);
        $manager->persist($therapist);


        $manager->flush();
    }
    public function loadUsersExercises(ObjectManager $manager)
    {
        $therapist = $this->getReference('patient_1');
    }

}
