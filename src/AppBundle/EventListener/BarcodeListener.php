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
use Symfony\Component\Validator\Constraints\False;
use Symfony\Component\Validator\Constraints\True;


class BarcodeListener
{

    public function prePersist(Barcode $barcode, LifecycleEventArgs $args)
    {
        //En primer lugar, definimos si vamos emplear el contador de códigos de la marca, y
        //el código base
        $use_counter = True; //Variable para indicar si emplearemos o no el contador de cóndigos de la marca
        $base_code = ''; //Variable para almacenar el código excepto el dígito de control

        if(!empty($barcode->getBasecode())){
            $base_code = (string) $barcode->getBasecode();
            $use_counter = False;
        } else {
            //Se toma como código base el SIGUIENTE valor del contador de productos de la marca
            $base_code = (string) ($barcode->getTrademark()->getCounter() + 1);
            $base_code = sprintf("%05d", $base_code);
            $use_counter = True;
        }

        //Para el tipo de código solicitado: se completa el código sin incluir el dígito de verificación,
        //posteriormente se genera el código, se fija en la varialbe correspondiente de Barcode,
        //y si se empleó, se incrementa el contador de la marca
        switch($barcode->getType()) {
            case 'TYPECODE_GTIN_12':
                //Almacenamos el código sin el dígito de verificación
                $codeWithoutChecksum = $barcode->getTrademark()->getPrefixUPC() . $base_code;
                //Obtenemos el código de barras, es decir, incluido el dígito de verificación
                $options = array('text' => $codeWithoutChecksum);
                $new_code = new \Zend\Barcode\Object\Upca($options);
                $barcode->setCode($new_code->getText());
                //Si hemos empleado el contador de la marca, lo incrementamos
                if($use_counter) $barcode->getTrademark()->setCounter( 1 + $barcode->getTrademark()->getCounter());
                break;
            case 'TYPECODE_GTIN_13':
                //Almacenamos el código sin el dígito de verificación
                $codeWithoutChecksum = $barcode->getTrademark()->getPrefix() . $base_code;
                //Obtenemos el código de barras, es decir, incluido el dígito de verificación
                $options = array('text' => $codeWithoutChecksum);
                $new_code = new \Zend\Barcode\Object\Ean13($options);
                $barcode->setCode($new_code->getText());
                //Si hemos empleado el contador de la marca, lo incrementamos
                if($use_counter) $barcode->getTrademark()->setCounter( 1 + $barcode->getTrademark()->getCounter());
                break;
            case 'TYPECODE_GTIN_14':
                //$entity = $args->getEntity();
                //$codeWithoutChecksum = $entity->getLogisticIndicator() . $barcode->getTrademark()->getPrefix() . $barcode->getBasecode();
                //$codeWithoutChecksum = $barcode->getLogisticIndicator() . $barcode->getTrademark()->getPrefix() . $barcode->getBasecode();

                //Almacenamos el código sin el dígito de verificación
                $codeWithoutChecksum = ((string) $barcode->getTableLogisticVariables()->getLogisticIndicator() ) . $barcode->getTrademark()->getPrefix() . $base_code;
                //Obtenemos el código de barras, es decir, incluido el dígito de verificación
                $options = array('text' => $codeWithoutChecksum);
                $new_code = new \Zend\Barcode\Object\Itf14($options);
                $barcode->setCode($new_code->getText());
                //Si hemos empleado el contador de la marca, lo incrementamos
                if($use_counter) $barcode->getTrademark()->setCounter( 1 + $barcode->getTrademark()->getCounter());
                break;
            default:
                //console.log('Error TYPO DE CÓDIGO NO CNENCOTRADO - archivo BarcodeListener.php');
                echo "ESTOY EN DEFAULT - ERROR al generar el código - archivo BarcodeListener.php";
        }
    }
}
