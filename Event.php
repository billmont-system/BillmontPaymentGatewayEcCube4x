<?php

namespace Plugin\BillmontPaymentGateway;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Eccube\Event\TemplateEvent;

class Event implements EventSubscriberInterface
{
    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            '@admin/Order/edit.twig' => 'onAdminOrderEditTwig',
            '@admin/Order/index.twig' => 'onAdminOrderIndexTwig',
        ];
    }

    public function onAdminOrderEditTwig(TemplateEvent $event){
      $event->addSnippet('@BillmontPaymentGateway/admin/order_edit.twig');
    }

    public function onAdminOrderIndexTwig(TemplateEvent $event){
      $event->addSnippet('@BillmontPaymentGateway/admin/order_index.twig');
    }
}
