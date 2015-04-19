<?php
/**
 * Created by PhpStorm.
 * User: jmb
 * Date: 15/04/15
 * Time: 22:45
 */

namespace AppBundle\Listener;


use Doctrine\ORM\Event\LifecycleEventArgs;
use AppBundle\Entity;
use AppBundle\Entity\Barcode;


class Listener
{

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        //$entityManager = $args->getEntityManager();
        //Aquí mi código para hacer setCode ...falta implementación
        //$entity->setCode('10101010');
        //$entity->setCode("10101010");

        //Comprobamos que estamos trabajando con la entidad BARCODE, pues el listener escucha todas las cases
        //if ($entity instanceof \AppBundle\Entity\Barcode ) {
        if ($entity instanceof Barcode ) {
            $entity->setCode("10101010");
        }
    }
}
