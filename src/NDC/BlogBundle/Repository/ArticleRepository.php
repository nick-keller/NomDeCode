<?php

namespace NDC\BlogBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ArticleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ArticleRepository extends EntityRepository
{
    public function queryAll()
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.createdAt', 'DESC');
    }

    public function queryAllNotDraft()
    {
        return $this->createQueryBuilder('a')
            ->where('a.state != :state')
            ->setParameter('state', 'draft')
            ->orderBy('a.createdAt', 'DESC');
    }

    public function queryAllPublished()
    {
        return $this->createQueryBuilder('a')
            ->where('a.state = :state')
            ->setParameter('state', 'published')
            ->orderBy('a.createdAt', 'DESC');
    }

    public function querySearch($query, array $techs, array $categories, array $users)
    {
        $keywords = explode(' ', strtolower($query));
        $map = array(
            'title' => array(),
            'tech' => array(),
            'category' => array(),
            'author' => array(),
        );

        foreach($keywords as $word){
            if(in_array($word, $techs))
                $map['tech'][] = $word;
            else if(in_array($word, $categories))
                $map['category'][] = $word;
            else if(in_array($word, $users))
                $map['author'][] = $word;
            else
                $map['title'][] = $word;
        }

        $qb = $this->createQueryBuilder('a')
            ->select('a')
            ->join('a.category', 'c')
            ->join('a.author', 'u')
            ->orderBy('a.createdAt', 'DESC');

        foreach($map as $field => $data){
            if($field == 'title'){
                foreach($data as $id => $keyword)
                    $qb->andWhere("a.title LIKE :keyword$id")
                        ->setParameter("keyword$id", "%$keyword%");
            }else if($field == 'tech'){
                foreach($data as $id => $tech)
                    $qb->andWhere(":tech$id MEMBER OF a.techs")
                        ->setParameter("tech$id", $tech);
            }else if($field == 'author'){
                $qb->andWhere("u.username IN (:authors)")
                    ->setParameter('authors', $data);
            }else if($field == 'category'){
                $qb->andWhere("c.slug IN (:categories)")
                    ->setParameter('categories', $data);
            }
        }

        return $qb->getQuery();
    }
}
