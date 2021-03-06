<?php
/**
 * Created by PhpStorm.
 * User: Joaquín & María
 * Date: 11/04/15
 * Time: 20:08
 */

namespace AppBundle\Doctrine\ORM;

/**
 * Class TableLogisticVariablesRepository
 * @package AppBundle\Doctrine\ORM
 */
class TableLogisticVariablesRepository extends CustomRepository
{

    /**
     * @param $typeTableLogisticVariables
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getTableLogisticVariablesAsList($typeTableLogisticVariables)
    {
        $qb = $this->getQueryBuilder();
        $query = $qb->where($qb->expr()->eq('o.type', ':type'))
            ->setParameter('type', $typeTableLogisticVariables)
        ;

        return $query;
    }

    /**
     * @param $type
     */
    public function createTableLogisticVariablesQuery($type)
    {
        $query = $this->createQueryBuilder('b');

        $query->leftJoin('b.tableLogisticVariables', 't')
            ->where(($query->expr()->eq('t.type', '?1')))
            ->andWhere($query->expr()->isNotNull('b.parent'))
            ->orderBy('b.left')
            ->setParameter('1', $type);
    }

    /**
     * @param $trademark_id
     * @return array
     */
    public function findByTrademarkId($trademark_id)
    {
        $query = $this->getEntityManager()->createQuery("
            SELECT tablelogisticVariables
            FROM AppBundle:TableLogisticVariables tablelogisticVariables
            LEFT JOIN tablelogisticVariables.trademark trademark
            WHERE trademark.id = :trademark_id
        ")->setParameter('trademark_id', $trademark_id);

        return $query->getArrayResult();
    }
}
