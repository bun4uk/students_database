<?php
/**
 * Created by PhpStorm.
 * User: v.bunchuk
 * Date: 17.01.17
 * Time: 15:41
 */

namespace StudentBundle\Repository;

use Doctrine\ORM\EntityRepository;

class StudentRepository extends EntityRepository
{

    public function getCount()
    {
        $queryBuilder = $this->createQueryBuilder('student');

        $query = $queryBuilder->select('COUNT(student)')
            ->where('student.path is NULL')
            ->getQuery();

        return $query->getSingleScalarResult();
    }

    public function getStudentsWithoutSlug()
    {
        $queryBuilder = $this->createQueryBuilder('student');
        $query = $queryBuilder->select('student')
            ->where('student.path is NULL')
            ->getQuery();

        return $query;
    }

    public function getSlugs()
    {
        $slugs = [];
        $result =  $this->createQueryBuilder('s')
            ->select('s.path')
            ->where('s.path is not NULL')
            ->getQuery()
            ->getResult();

        foreach ($result as $value) {
            $slugs[] = $value['path'];
        }

        return $slugs;
    }
}
