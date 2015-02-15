<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 8/10/14
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
        $this->getSession()->visit($this->generatePageUrl('company_list'));
    }

    /**
     * @Then debo estar en la página de listado de compañías
     */
    public function iShouldBeOnCompanyList()
    {
        $this->assertSession()->addressEquals($this->generatePageUrl('company_list'));
    }

    /**
     * @Given /^estoy conectado como usuario "([^".]*)" y contraseña "([^".]*)"$/
     */
    public function iAmLoggedAs($user, $password)
    {
        $this->getSession()->visit('/admin/login');
        $this->fillField('_username', $user);
        $this->fillField('_password', $password);
        $this->pressButton('_submit');
    }

    /**
     * @When /presiono "([^".]*)" cerca de "([^".]*)"$/
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
}