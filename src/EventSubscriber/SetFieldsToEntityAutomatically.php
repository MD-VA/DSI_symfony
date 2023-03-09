<?php

namespace App\EventSubscriber;

use ApiPlatform\Symfony\EventListener\EventPriorities;
use App\Entity\Group;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class SetFieldsToEntityAutomatically implements EventSubscriberInterface
{
    public function __construct(private readonly TokenStorageInterface $tokenStorage)
    {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::VIEW => ['setFieldToEntity', EventPriorities::PRE_WRITE]
        ];
    }

    public function setFieldToEntity(ViewEvent $event): void
    {
        $entity = $event->getControllerResult();
        $token = $this->tokenStorage->getToken();
        if ($token !== null) {
            $user = $token->getUser();
            $method = $event->getRequest()->getMethod();
            if ($user !== null &&
                get_class($entity) === Group::class &&
                in_array($method, [Request::METHOD_POST, Request::METHOD_PATCH])
            ) {
                $entity->setOwner($user);
            }
        }
    }
}









