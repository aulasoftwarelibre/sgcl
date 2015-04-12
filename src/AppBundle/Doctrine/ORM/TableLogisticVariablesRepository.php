<?php
/**
 * Created by PhpStorm.
 * User: jmb
 * Date: 11/04/15
 * Time: 20:08
 */

namespace AppBundle\Doctrine\ORM;

use AppBundle\Entity;
use Doctrine\ORM\Query\Expr;

class TableLogisticVariablesRepository extends CustomRepository{
    public function findByTrademarkId($trademark_id)
    {
        $query = $this->getEntityManager()->createQuery("
            SELECT logisticIndicator
            FROM AppBundle:TableLogisticVariables logisticIndicator
            LEFT JOIN tablelogisticVariables.trademark trademark
            WHERE trademark.id = :trademark_id
        ")->setParameter('trademark_id', $trademark_id);

        return $query->getArrayResult();
    }
}
