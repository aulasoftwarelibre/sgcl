<?php
/**
 * Created by PhpStorm.
 * User: jmb
 * Date: 14/03/15
 * Time: 21:34
 */

namespace AppBundle\Behat;

use AppBundle\Entity\Company;
use AppBundle\Entity\Trademark;
use AppBundle\Entity\TableLogisticVariables;
use Behat\Gherkin\Node\TableNode;
use Sylius\Bundle\ResourceBundle\Behat\DefaultContext;

class TableLogisticVariablesContext extends DefaultContext{
    /**
     * @Given existen las siguientes variables logísticas:
     */
    public function createTableLogisticVariables(TableNode $tableNode)
    {
        $em = $this->getEntityManager();
        foreach ($tableNode->getHash() as $tableLogisticVariablesHash) {
            $tableLogisticVariable = new TableLogisticVariables();
            $tableLogisticVariable->setLogisticIndicator( $tableLogisticVariablesHash['indicador_logístico'] );
            $tableLogisticVariable->setDescription( $tableLogisticVariablesHash['descripcion'] );

            $em = $this->getEntityManager();
            $trademark = $em->getRepository('AppBundle:Trademark')->findOneBy(array('name' => $tableLogisticVariablesHash['marca']));
            $tableLogisticVariable->setTrademark( $trademark );

            $em->persist($tableLogisticVariable);
        }

        $em->flush();
    }
}
