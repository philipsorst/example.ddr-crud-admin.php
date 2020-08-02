<?php

namespace App\Event\Subscriber;

use App\Entity\CreatedInterface;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;

/**
 * @author Philip Washington Sorst <philip@sorst.net>
 */
class CreatedSubscriber implements EventSubscriber
{
    /**
     * {@inheritdoc}
     */
    public function getSubscribedEvents()
    {
        return [Events::prePersist];
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $this->updateCreated($args);
    }

    public function updateCreated(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if ($entity instanceof CreatedInterface && null === $entity->getCreated()) {
            $entity->setCreated((int)(microtime(true) * 1000));
        }
    }
}
