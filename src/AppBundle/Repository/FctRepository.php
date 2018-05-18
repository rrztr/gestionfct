<?php
/**
 * Created by PhpStorm.
 * User: 2DAW
 * Date: 08/03/2018
 * Time: 16:18
 */

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;

class FctRepository extends EntityRepository
{
    public function findByAnyo($pagina = 1)
    {
        $query = $this->createQueryBuilder('c')
            ->orderBy('c.anyo', 'ASC')
            ->getQuery();
        return $this->creaPaginador($query, $pagina);
    }

    private function creaPaginador($query, $pagina)
    {
        $paginador = new Pagerfanta(new DoctrineORMAdapter($query));
        $paginador->setMaxPerPage(5);
        $paginador->setCurrentPage($pagina);
        return $paginador;
    }

    public function searchByNombreCiclo($pagina= 1,$alumno,$profesor,$ciclo){
        $query = $this->createQueryBuilder('c')
            ->innerJoin('c.alumno','q')
            ->innerJoin('c.profesor','s')
            ->where('q.nombre LIKE :nombre AND s.nombre LIKE :nombreprof AND c.cod_ciclo LIKE :ciclo')
            ->setParameter('nombre','%'.$alumno.'%')
            ->setParameter('nombreprof','%'.$profesor.'%')
            ->setParameter('ciclo','%'.$ciclo.'%')
            ->getQuery();

        return $this->creaPaginador($query, $pagina);
    }

//
//    public function searchByNombreCiclo($pagina= 1,$alumno,$profesor){
//        $query = $this->createQueryBuilder('c')
//            ->innerJoin('c.alumno','q')
//            ->innerJoin('c.profesor','s')
//            ->where('q.nombre LIKE :nombre AND s.nombre LIKE :nombreprof')
//            ->setParameter('nombre','%'.$alumno.'%')
//            ->setParameter('nombreprof','%'.$profesor.'%')
//            ->getQuery();
//
//        return $this->creaPaginador($query, $pagina);
//    }
}