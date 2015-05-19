<?php
/**
 * Created by PhpStorm.
 * User: jmb
 * Date: 04/01/15
 * Time: 9:57
 */

namespace AppBundle\Behat;

use Sylius\Bundle\ResourceBundle\Behat\DefaultContext;

class CoreContext extends DefaultContext
{
    /**
     * @Given estoy en la página del escritorio
     */
    public function iAmOnDashboard()
    {
        $this->getSession()->visit($this->generatePageUrl('sonata_admin_dashboard'));
    }

    /**
     * @Given estoy en la página de listado de compañías
     */
    public function iAmOnCompanyList()
    {
        $this->getSession()->visit($this->generatePageUrl('admin_app_company_list'));
    }

    /**
     * @Given estoy en la página de listado de marcas
     */
    public function iAmOnTrademarkList()
    {
        $this->getSession()->visit($this->generatePageUrl('admin_app_trademark_list'));
    }

    /**
     * @Given estoy en la página de listado de códigos de barras
     */
    public function iAmOnbarcodeList()
    {
        $this->getSession()->visit($this->generatePageUrl('admin_app_barcode_list'));
    }

    /**
     * @Given estoy en la página de listado de variables logísticas
     */
    public function iAmOnTableLogisticVariablesList()
    {
        $this->getSession()->visit($this->generatePageUrl('admin_app_tablelogisticvariables_list'));
    }

    /**
     * @Given estoy en la página de creación de compañías
     */
    public function iAmOnCompanyCreate()
    {
        $this->getSession()->visit($this->generatePageUrl('admin_app_company_create'));
    }

    /**
     * @Given estoy en la página de creación de marcas
     */
    public function iAmOnTrademarkCreate()
    {
        $this->getSession()->visit($this->generatePageUrl('admin_app_trademark_create'));
    }

    /**
     * @Given estoy en la página de creación códigos de barras
     */
    public function iAmOnBarcodeCreate()
    {
        $this->getSession()->visit($this->generatePageUrl('admin_app_barcode_create'));
    }

    /**
     * @Given estoy en la página de creación variables logísticas
     */
    public function iAmOnTableLogisticVariablesCreate()
    {
        $this->getSession()->visit($this->generatePageUrl('admin_app_tablelogisticvariables_create'));
    }

    /**
     * @Given /^estoy en la página de edición de compañía con "([^".]*)" denominado "([^".]*)"$/
     */
    public function iAmOnOneCompanyEdit($campo, $valor)
    {
        $em = $this->getEntityManager();
        $company = $em->getRepository('AppBundle:Company')->findOneBy(array($campo => $valor));
        $this->assertSession()->addressEquals(
            $this->generatePageUrl('admin_app_company_edit', array('id' => $company->getId()))
        );
    }

    /**
     * @Then debo estar en la página de listado de compañías
     */
    public function iShouldBeOnCompanyList()
    {
        $this->assertSession()->addressEquals($this->generatePageUrl('admin_app_company_list'));
    }

    /**
     * @Then debo estar en la página de listado de marcas
     */
    public function iShouldBeOnTrademarkList()
    {
        $this->assertSession()->addressEquals($this->generatePageUrl('admin_app_trademark_list'));
    }

    /**
     * @Then debo estar en la página de listado de códigos de barras
     */
    public function iShouldBeOnBarcodeList()
    {
        $this->assertSession()->addressEquals($this->generatePageUrl('admin_app_barcode_list'));
    }

    /**
     * @Then debo estar en la página de listado de variables logísticas
     */
    public function iShouldBeOnTableLogisticVariablesList()
    {
        $this->assertSession()->addressEquals($this->generatePageUrl('admin_app_tablelogisticvariables_list '));
    }

    /**
     * @Given /^estoy conectado como usuario "([^".]*)" y contraseña "([^".]*)"$/
     */
    public function iAmLoggedAs($user, $password)
    {
        $this->getSession()->visit('/login');
        $this->fillField('_username', $user);
        $this->fillField('_password', $password);
        $this->pressButton('Entrar');
    }

    /**
     * @When /^presiono "([^".]*)" cerca de "([^".]*)"$/
     */
    public function iClickNear($button, $value)
    {
        $tr = $this->assertSession()->elementExists('css', sprintf('table tbody tr:contains("%s")', $value));

        $locator = sprintf('button:contains("%s")', $button);

        if ($tr->has('css', $locator)) {
            $tr->find('css', $locator)->press();
        } else {
            $tr->clickLink($button);
        }
    }

    /**
     * @Then /^debería estar en la página edición de compañia con "([^".]*)" denominado "([^".]*)"$/
     */
    public function iShouldBeOnCompanyEdit($campo, $valor)
    {
        $em = $this->getEntityManager();
        $company = $em->getRepository('AppBundle:Company')->findOneBy(array($campo => $valor));
        $this->assertSession()->addressEquals(
            $this->generatePageUrl('admin_app_company_edit', array('id' => $company->getId()))
        );
    }

    /**
     * @Then /^debería estar en la página edición de marca con "([^".]*)" denominado "([^".]*)"$/
     */
    public function iShouldBeOnTrademarkEdit($campo, $valor)
    {
        $em = $this->getEntityManager();
        $trademark = $em->getRepository('AppBundle:Trademark')->findOneBy(array($campo => $valor));
        $this->assertSession()->addressEquals($this->generatePageUrl('admin_app_trademark_edit', array('id' => $trademark->getId())));
    }

    /**
     * @Then /^debería estar en la página edición de códigos de barras con "([^".]*)" denominado "([^".]*)"$/
     */
    public function iShouldBeOnBarcodeEdit($campo, $valor)
    {
        $em = $this->getEntityManager();
        $barcode = $em->getRepository('AppBundle:Barcode')->findOneBy(array($campo => $valor));
        $this->assertSession()->addressEquals($this->generatePageUrl('barcode_edit', array('id' => $barcode->getId())));
    }

    /**
     * @Then /^debería estar en la página edición de variables logísticas con "([^".]*)" denominado "([^".]*)"$/
     */
    public function iShouldBeOnTableLogisticVariablesEdit($campo, $valor)
    {
        $em = $this->getEntityManager();
        $tablelogisticvariables = $em->getRepository('AppBundle:TableLogisticVariables')->findOneBy(array($campo => $valor));
        $this->assertSession()->addressEquals($this->generatePageUrl('admin_app_tablelogisticvariables_edit', array('id' => $tablelogisticvariables->getId())));
    }

    /**
     * @Then /^debería estar en la página edición de variables logísticas con "([^".]*)" denominado "([^".]*)" y "([^".]*)" denominada "([^".]*)"$/
     */
    public function iShouldBeOnTableLogisticVariablesEdit_indicatorAndDescription($campo1, $valor1, $campo2, $valor2)
    {
        $em = $this->getEntityManager();
        $tablelogisticvariables = $em->getRepository('AppBundle:TableLogisticVariables')->findOneBy(array($campo1 => $valor1, $campo2 => $valor2));
        $this->assertSession()->addressEquals($this->generatePageUrl('admin_app_tablelogisticvariables_edit', array('id' => $tablelogisticvariables->getId())));
    }
}
