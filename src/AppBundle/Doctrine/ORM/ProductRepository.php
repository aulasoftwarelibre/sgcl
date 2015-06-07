<?php
/**
 * Created by PhpStorm.
 * User: Joaquín & María
 * Date: 13/04/15
 * Time: 0:11
 */

namespace AppBundle\Doctrine\ORM;

use AppBundle\Entity;
use Doctrine\ORM\Query\Expr;

/**
 * Class ProductRepository
 * @package AppBundle\Doctrine\ORM
 */
class ProductRepository extends CustomRepository
{

    /**
     * @param $barcode_id
     * @return array
     */
    public function findByCodeId($barcode_id)
    {
        $query = $this->getEntityManager()->createQuery("
            SELECT product
            FROM AppBundle:Product product
            WHERE product.barcodeCU = :code
            OR product.barcodeSU = :code
        ")->setParameter('code', $barcode_id);

        return $query->getArrayResult();
    }
}
