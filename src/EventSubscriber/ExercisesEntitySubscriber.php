<?php

namespace App\EventSubscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Exercises;
use App\Entity\ExercisesType;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class ExercisesEntitySubscriber implements EventSubscriberInterface
{
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage=$tokenStorage;
    }

    public static function getSubscribedEvents()
    {
        return [
          KernelEvents::VIEW=>['getAuthenticatedUser', EventPriorities::PRE_WRITE]
        ];
    }
    public function getAuthenticatedUser(ViewEvent $event){
        $entity = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        /**
         * @var UserInterface $user
         */
        $user = $this->tokenStorage->getToken()->getUser();
        if(!$entity instanceof User || Request::METHOD_POST !== $method)
        {
            return;
        }
    }
}