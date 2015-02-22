<?php
/**
 * Created by PhpStorm.
 * User: jmb
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

            //Si "prefixUPC" es distinto de NULL, entonces se guarda
            if($trademarkHash['prefijoUPC'] != NULL)
            {
                $trademark->setPrefixUPC( $trademarkHash['prefijoUPC'] );
            }

            //Primero tenemos que obtener el valor 'company_id' correspondiente al nombre de la compañía
            $em = $this->getEntityManager();
            $company = $em->getRepository('AppBundle:Company')->findOneBy(array('name' => $trademarkHash['compañía']));
            $trademark->setCompany( $company );

            $em->persist($trademark);
        }

        $em->flush();
    }
}