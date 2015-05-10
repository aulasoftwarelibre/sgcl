<?php
/**
 * Created by PhpStorm.
 * User: jmb
 * Date: 15/04/15
 * Time: 22:45
 */

namespace AppBundle\EventListener;


use AppBundle\Entity;
use AppBundle\Entity\Barcode;
use Doctrine\ORM\Event\LifecycleEventArgs;


class BarcodeListener
{

    public function prePersist(Barcode $barcode, LifecycleEventArgs $args)
    {
        if (null === $barcode->getCode()) {
            $barcode->setCode( $barcode->generateCode($barcode) );
            if ($barcode->getWithCounter()) $barcode->getTrademark()->setCounter(1 + $barcode->getTrademark()->getCounter());

            //if( $barcode->getWithCounter() == true ){$j = 'SI';} else {$j = 'NO';}
            //throw new \InvalidArgumentException("El valor de la pregunta es: " . $j );

        }
    }
}
