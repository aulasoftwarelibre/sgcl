<?php
/**
 * Created by PhpStorm.
 * User: jmb
 * Date: 13/04/15
 * Time: 0:11
 */

namespace AppBundle\Doctrine\ORM;

use AppBundle\Entity;
use Doctrine\ORM\Query\Expr;

class ProductRepository extends CustomRepository
{

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
