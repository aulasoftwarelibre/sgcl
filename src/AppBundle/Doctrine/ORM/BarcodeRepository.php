<?php
/**
 * Created by PhpStorm.
 * User: jmb
 * Date: 21/03/15
 * Time: 12:03
 */

namespace AppBundle\Doctrine\ORM;

use AppBundle\Entity;
use Doctrine\ORM\Query\Expr;

class BarcodeRepository extends CustomRepository
{
    public function getBarcodeAsList($typeBarcode)
    {
        $qb = $this->getQueryBuilder();
        $query = $qb->where($qb->expr()->eq('o.type', ':type'))
            ->setParameter('type', $typeBarcode)
        ;

        return $query;
    }


    public function createBarcodeQuery($type)
    {
        $query = $this->createQueryBuilder('b');

        $query->leftJoin('b.barcode', 't')
            ->where(($query->expr()->eq('t.type', '?1')))
            ->andWhere($query->expr()->isNotNull('b.parent'))
            ->orderBy('b.left')
            ->setParameter('1', $type);
    }
}
