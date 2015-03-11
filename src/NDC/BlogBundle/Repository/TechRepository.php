<?php

namespace NDC\BlogBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * TechRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TechRepository extends EntityRepository
{
    public function queryAll()
    {
        return $this->createQueryBuilder('t')
            ->orderBy('t.name');
    }

    public function findAllSlug()
    {
        $r = $this->createQueryBuilder('t')
            ->select('t.slug')
            ->getQuery()
            ->getArrayResult();

        $result = array();
        foreach($r as $l)
            $result[] = $l['slug'];

        return $result;
    }

    public function findFromSlugs(array $slugs)
    {
        return $this->createQueryBuilder('t')
            ->where('t.slug IN (:slugs)')
            ->setParameter('slugs', $slugs)
            ->getQuery()
            ->getResult();
    }
}
