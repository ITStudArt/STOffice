<?php

namespace App\Controller;

use ApiPlatform\Core\Validator\ValidatorInterface;
use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use PHPUnit\Util\Json;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ResetPasswordAction
{
    /**
     * @var ValidatorInterface
     */
    private $validator;
    /**
     * @var UserPasswordHasherInterface
     */
    private $userPasswordHasher;
    /**
     * @var EntityManagerInterface
     */
    private $manager;
    /**
     * @var JWTTokenManagerInterface
     */
    private $JWTTokenManager;

    public function __construct(ValidatorInterface $validator,
    UserPasswordHasherInterface $userPasswordHasher,
    EntityManagerInterface $manager,
    JWTTokenManagerInterface $JWTTokenManager)
    {
        $this->validator=$validator;
        $this->userPasswordHasher = $userPasswordHasher;
        $this->manager = $manager;
        $this->JWTTokenManager = $JWTTokenManager;
    }
    public function __invoke(User $data)
    {
        // $reset = new Reset Password Action();
        // $reset();
        //var_dump($data->getNewPassword(), $data->getNewRetypedPassword(), $data->getOldPassword(), $data->getRetypedPassword());die();
        $this->validator->validate($data);
        $data->setPassword($this->userPasswordHasher->hashPassword($data,$data->getNewPassword()));
        $data->setPasswordChangeDate(time());
        $this->manager->flush();
        $token = $this->JWTTokenManager->create($data);
        return new JsonResponse(['token'=>$token]);



    }

}