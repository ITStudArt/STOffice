<?php

namespace App\Controller;



use ApiPlatform\Core\Validator\Exception\ValidationException;
use ApiPlatform\Core\Validator\ValidatorInterface;
use App\Entity\Exercises;
use App\Form\ExerciseType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Vich\UploaderBundle\Naming\UniqidNamer;

class UploadExercisesAction
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var ValidatorInterface
     */
    private $validator;

    public function __construct(
        FormFactoryInterface $formFactory,
        EntityManagerInterface $entityManager,
        ValidatorInterface $validator
    ){

        $this->formFactory = $formFactory;
        $this->entityManager = $entityManager;
        $this->validator = $validator;
    }
    public function __invoke(Request $request){
        $exercise = new Exercises();
        $form = $this->formFactory->create(ExerciseType::class,$exercise);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $exercise->setName($request->get('name'));
            $this->entityManager->persist($exercise);
            $this->entityManager->flush();
            $exercise->setFile(null);
            return $exercise;
        }
        throw new ValidationException(
            $this->validator->validate($exercise)
        );


    }

}