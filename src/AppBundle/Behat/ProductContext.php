<?php
/**
 * Created by PhpStorm.
 * User: Joaquín & María
 * Date: 14/03/15
 * Time: 21:42
 */

namespace AppBundle\Behat;

use AppBundle\Entity\Product;
use AppBundle\Entity\Trademark;
use AppBundle\Entity\Barcode;
use Behat\Gherkin\Node\TableNode;
use Sylius\Bundle\ResourceBundle\Behat\DefaultContext;

/**
 * Class ProductContext
 * @package AppBundle\Behat
 */
class ProductContext extends DefaultContext{
    /**
     * @Given existen los siguientes productos:
     */
    public function createProducts(TableNode $tableNode)
    {
        $em = $this->getEntityManager();
        foreach ($tableNode->getHash() as $productHash) {
            $product = new Product();
            $product->setCode( $productHash['codigo'] );
            $product->setName( $productHash['descripcion'] );
            $product->setDescription( $productHash['descripcion completa'] );
            $product->setNumberConsumerUnit( $productHash['numero UC'] );
            $product->setChangeHistory( $productHash['historial'] );

            //We obtain the corresponding identifier to the trademark name
            $em = $this->getEntityManager();
            $trademark = $em->getRepository('AppBundle:Trademark')->findOneBy(array('name' => $productHash['marca']));
            $product->setTrademark( $trademark );

            //We obtain the corresponding identifier to the barcode, both the CU and SU
            $em = $this->getEntityManager();
            $barcodeCU = $em->getRepository('AppBundle:Barcode')->findOneBy(array('code' => $productHash['codigo UC']));
            $product->setBarcodeCU( $barcodeCU );
            $barcodeSU = $em->getRepository('AppBundle:Barcode')->findOneBy(array('code' => $productHash['codigo UV']));
            $product->setBarcodeSU( $barcodeSU );

            $em->persist($product);
        }

        $em->flush();
    }
}
