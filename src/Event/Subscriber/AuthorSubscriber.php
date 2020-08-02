<?php

namespace App\Event\Subscriber;

use App\Entity\AuthorInterface;
use App\Security\SecurityService;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;

/**
 * @author Philip Washington Sorst <philip@sorst.net>
 */
class AuthorSubscriber implements EventSubscriber
{
    private SecurityService $securityService;

    public function __construct(SecurityService $securityService)
    {
        $this->securityService = $securityService;
    }

    /**
     * {@inheritdoc}
     */
    public function getSubscribedEvents()
    {
        return [Events::prePersist];
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $this->updateAuthor($args);
    }

    public function updateAuthor(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if ($entity instanceof AuthorInterface && null === $entity->getAuthor()) {
            $entity->setAuthor($this->securityService->getCurrentUser());
        }
    }
}
