<?php
/**
 * Created by PhpStorm.
 * User: Joaquín & María
 * Date: 14/03/15
 * Time: 21:34
 */

namespace AppBundle\Behat;

use AppBundle\Entity\Barcode;
use AppBundle\Entity\Trademark;
use Behat\Gherkin\Node\TableNode;
use Sylius\Bundle\ResourceBundle\Behat\DefaultContext;

class BarcodeContext extends DefaultContext{
    /**
     * @Given existen los siguientes códigos de barras:
     */
    public function createBarcodes(TableNode $tableNode)
    {
        $em = $this->getEntityManager();
        foreach ($tableNode->getHash() as $barcodeHash) {
            $barcode = new Barcode();
            $barcode->setType( $barcodeHash['tipo'] );
            $barcode->setCode( $barcodeHash['codigo'] );
            $barcode->setComment( $barcodeHash['comentario'] );

            //We obtain the corresponding identifier to the trademark name
            $em = $this->getEntityManager();
            $trademark = $em->getRepository('AppBundle:Trademark')->findOneBy(array('name' => $barcodeHash['marca']));
            $barcode->setTrademark( $trademark );

            $em->persist($barcode);
        }

        $em->flush();
    }
}
