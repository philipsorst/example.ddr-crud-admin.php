<?php

namespace App\Event\Subscriber;

use App\Entity\UpdatedInterface;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;

/**
 * @author Philip Washington Sorst <philip@sorst.net>
 */
class UpdatedSubscriber implements EventSubscriber
{
    /**
     * {@inheritdoc}
     */
    public function getSubscribedEvents()
    {
        return [
            Events::prePersist,
            Events::preUpdate,
        ];
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $this->updateUpdated($args);
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $this->updateUpdated($args);
    }

    public function updateUpdated(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if ($entity instanceof UpdatedInterface && null === $entity->getUpdated()) {
            $entity->setUpdated((int)(microtime(true) * 1000));
        }
    }
}
