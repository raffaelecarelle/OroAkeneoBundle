<?php

namespace Creativestyle\Bundle\AkeneoBundle\Async\Topic;

class ImportProductsTopic extends \Oro\Component\MessageQueue\Topic\AbstractTopic
{
    public const IMPORT_PRODUCTS = 'oro.integration.akeneo.product';

    public static function getName(): string
    {
        return self::IMPORT_PRODUCTS;
    }
    public static function getDescription(): string
    {
        // TODO: Implement getDescription() method.
        return '';
    }
    public function configureMessageBody(\Symfony\Component\OptionsResolver\OptionsResolver $resolver): void
    {
        // TODO: Implement configureMessageBody() method.
    }
}