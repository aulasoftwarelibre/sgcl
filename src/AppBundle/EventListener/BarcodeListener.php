<?php
/**
 * Created by PhpStorm.
 * User: jmb
 * Date: 15/04/15
 * Time: 22:45
 */

namespace AppBundle\EventListener;


use Doctrine\ORM\Event\LifecycleEventArgs;
use AppBundle\Entity;
use AppBundle\Entity\Barcode;


class BarcodeListener
{

    public function prePersist(Barcode $barcode, LifecycleEventArgs $args)
    {
        if (!empty($barcode->getBasecode())) {
            $barcode->setCode(($barcode->getBasecode()));
        } else {
            $barcode->setCode( mt_rand( 10000, 10000000 ) );
        }
    }
}
