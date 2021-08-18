<?php

namespace App\DataFixtures;

use App\Entity\Exercises;
use App\Entity\ExercisesType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $this->loadExercisesTypes($manager);
        $this->loadExercises($manager);
    }
    public function loadExercisesTypes(ObjectManager $manager)
    {
        $exercise_type = new ExercisesType();
        $exercise_type->setType('doc_type');
        $exercise_type->setIcon('doc_icon');
        $manager->persist($exercise_type);

        $exercise_type = new ExercisesType();
        $exercise_type->setType('txt_type');
        $exercise_type->setIcon('txt_icon');
        $manager->persist($exercise_type);

        $manager->flush();
    }
    public function loadExercises(ObjectManager $manager)
    {
        $exercise = new Exercises();
        $exercise->setName('Exercise 1');
        $exercise->setPath('exercise_1_path');
        $manager->persist($exercise);

        $exercise = new Exercises();
        $exercise->setName('Exercise 2');
        $exercise->setPath('exercise_2_path');
        $manager->persist($exercise);

        $manager->flush();

    }
    public function loadPatients(ObjectManager $manager)
    {

    }
    public function loadTherapist(ObjectManager $manager)
    {

    }

}
