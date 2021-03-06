<?php

/**
 * Created by PhpStorm.
 * User: 2DAW
 * Date: 28/02/2018
 * Time: 17:04
 */

namespace  AppBundle\Repository;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;


class CicloRepository extends EntityRepository
{
    public function findByNombre($pagina = 1)
    {
        $query = $this->createQueryBuilder('c')
            ->orderBy('c.nombre', 'ASC')
            ->getQuery();
        return $this->creaPaginador($query, $pagina);
    }

    private function creaPaginador(Query $query, int $pagina)
    {
        $paginador = new Pagerfanta(new DoctrineORMAdapter($query));
        $paginador->setMaxPerPage(5);
        $paginador->setCurrentPage($pagina);
        return $paginador;
    }
}