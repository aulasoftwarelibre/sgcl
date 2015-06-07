<?php
/**
 * Created by PhpStorm.
 * User: Joaquín & María
 * Date: 15/02/15
 * Time: 12:47
 */

namespace AppBundle\Behat;


use AppBundle\Entity\Company;
use Behat\Gherkin\Node\TableNode;
use Sylius\Bundle\ResourceBundle\Behat\DefaultContext;

/**
 * Class CompanyContext
 * @package AppBundle\Behat
 */
class CompanyContext extends DefaultContext
{
    /**
     * @Given existen las siguientes compañías:
     */
    public function createCompanies(TableNode $tableNode)
    {
        $em = $this->getEntityManager();
        foreach ($tableNode->getHash() as $companyHash) {
            $company = new Company();
            $company->setName( $companyHash['nombre'] );
            $company->setNif( $companyHash['nif'] );

            $em->persist($company);
        }

        $em->flush();
    }
}