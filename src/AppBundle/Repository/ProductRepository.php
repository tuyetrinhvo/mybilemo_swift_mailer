<?php

namespace AppBundle\Repository;

class ProductRepository extends AbstractRepository
{
    public function search($term, $order = 'asc', $limit = 20, $offset = 0)
    {
        $qb = $this
            ->createQueryBuilder('p')
            ->select('p')
            ->orderBy('p.id', $order)
        ;

        if ($term) {
            $qb
                ->where('p.id LIKE ?1')
                ->setParameter(1, '%'.$term.'%')
            ;
        }

        return $this->paginate($qb, $limit, $offset);
    }
}