<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 15/02/15
 * Time: 12:47
 */

namespace AppBundle\Behat;


use AppBundle\Entity\Company;
use Behat\Gherkin\Node\TableNode;
use Sylius\Bundle\ResourceBundle\Behat\DefaultContext;

class CompanyContext extends DefaultContext
{
    /**
     * @Given existen las siguientes compañías:
     */
    public function createOrganizations(TableNode $tableNode)
    {
        $em = $this->getEntityManager();
        foreach ($tableNode->getHash() as $companyHash) {
            $company = new Company();
            $company->setName( $companyHash['nombre'] );
            $company->setCif( $companyHash['cif'] );

            $em->persist($company);
        }

        $em->flush();
    }
}