<?php

namespace App\Provider;

use DateTime;
use Dontdrinkandroot\CrudAdminBundle\Model\FieldDefinition;
use Dontdrinkandroot\CrudAdminBundle\Service\FieldRenderer\FieldRendererProviderInterface;

/**
 * @author Philip Washington Sorst <philip@sorst.net>
 */
class MicrotimeRendererProvider implements FieldRendererProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function supports(FieldDefinition $fieldDefinition, $value): bool
    {
        return 'microtime' === $fieldDefinition->getType();
    }

    /**
     * {@inheritdoc}
     */
    public function render(FieldDefinition $fieldDefinition, $value): string
    {
        return (new DateTime())->setTimestamp($value / 1000)->format('Y-m-d H:i:s');
    }
}
