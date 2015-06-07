<?php
/**
 * Created by PhpStorm.
 * User: Joaquín & María
 * Date: 21/03/15
 * Time: 11:59
 */

namespace AppBundle\Doctrine\ORM;

use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;

/**
 * Class CustomRepository
 * @package AppBundle\Doctrine\ORM
 */
class CustomRepository extends EntityRepository
{
    /**
     * @param mixed $id
     *
     * @return null|object
     */
    public function find($id)
    {
        if (is_array($id)) {
            $id = current($id);
        }
        return parent::find($id);
    }
}
