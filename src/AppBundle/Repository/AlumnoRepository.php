<?php

/**
 * Created by PhpStorm.
 * User: 2DAW
 * Date: 26/02/2018
 * Time: 20:37
 */

namespace  AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;


class AlumnoRepository extends EntityRepository
{
    public function findByNombre($pagina = 1)
    {
        $query = $this->createQueryBuilder('c')
            ->orderBy('c.nombre', 'ASC')
            ->getQuery();
        return $this->creaPaginador($query, $pagina);
    }

    public function findByCiclo($pagina = 1)
    {
        $query = $this->createQueryBuilder('a')
            ->innerJoin('a.ciclo','c')
            ->orderBy('c.nombre', 'ASC')
            ->getQuery();
        return $this->creaPaginador($query, $pagina);
    }

    public function searchByNombreCiclo($pagina= 1,$nombre,$ciclo){
        $query = $this->createQueryBuilder('c')
            ->innerJoin('c.ciclo','q')
            ->where('c.nombre LIKE :nombre AND q.codigo LIKE :codigo')
            ->setParameter('nombre','%'.$nombre.'%')
            ->setParameter('codigo','%'.$ciclo.'%')
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