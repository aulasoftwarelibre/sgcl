<?php
/**
 * Created by PhpStorm.
 * User: Joaquín & María
 * Date: 22/02/15
 * Time: 17:10
 */

namespace AppBundle\Behat;


use AppBundle\Entity\Trademark;
use AppBundle\Entity\Company;
use Behat\Gherkin\Node\TableNode;
use Sylius\Bundle\ResourceBundle\Behat\DefaultContext;

class TrademarkContext extends DefaultContext
{
    /**
     * @Given existen las siguientes marcas:
     */
    public function createTrademarks(TableNode $tableNode)
    {
        $em = $this->getEntityManager();
        foreach ($tableNode->getHash() as $trademarkHash) {
            $trademark = new Trademark();
            $trademark->setName( $trademarkHash['nombre'] );
            $trademark->setPrefix( $trademarkHash['prefijo'] );

            if($trademarkHash['prefijoUPC'] != NULL)
            {
                $trademark->setPrefixUPC( $trademarkHash['prefijoUPC'] );
            }

            //We obtain the corresponding identifier to the company name
            $em = $this->getEntityManager();
            $company = $em->getRepository('AppBundle:Company')->findOneBy(array('name' => $trademarkHash['compañía']));
            $trademark->setCompany( $company );

            $em->persist($trademark);
        }

        $em->flush();
    }
}