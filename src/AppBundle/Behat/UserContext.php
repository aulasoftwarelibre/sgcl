<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 15/02/15
 * Time: 12:49
 */

namespace AppBundle\Behat;


use AppBundle\Entity\User;
use Behat\Gherkin\Node\TableNode;
use Sylius\Bundle\ResourceBundle\Behat\DefaultContext;

class UserContext extends DefaultContext
{
    /**
     * @Given /^existen los siguientes usuarios:$/
     */
    public function generateUsers(TableNode $usersTable)
    {
        $em = $this->getEntityManager();
        foreach ($usersTable->getHash() as $userHash) {
            $user = $this->getEntityManager()->getRepository('ApplicationSonataUserBundle:User')->findOneByUsername($userHash['nombre']);
            if (!$user) {
                $user = new User();
            }
            $user->setUsername($userHash['nombre']);
            $user->setPlainPassword($userHash['clave']);
            $user->setEmail($userHash['email']);
            $user->setEnabled($userHash['activado']);
            $user->addRole($userHash['rol']);

            $em->persist($user);
        }
        $em->flush();
    }
}