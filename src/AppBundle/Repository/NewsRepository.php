<?php
    /**
     * Created by PhpStorm.
     * User: andrey
     * Date: 08.04.18
     * Time: 20:43
     */

    namespace AppBundle\Repository;


    use Doctrine\ORM\EntityRepository;

    class NewsRepository extends EntityRepository
    {

        public function findFiveRecent($category)
        {
            return $this->createQueryBuilder('topnews')
                ->andWhere('topnews.isActive=:isActive')
                ->andWhere('topnews.category=:category')
                ->setParameter('isActive',1)
                ->setParameter("category",$category)
                ->orderBy('topnews.createdAt','DESC')
                ->setMaxResults(5)
                ->getQuery()
                ->execute();
        }




    }