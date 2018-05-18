<?php
/**
 * Created by PhpStorm.
 * User: Rafa
 * Date: 27/02/2018
 * Time: 1:52
 */

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;


class EmpresaRepository extends EntityRepository
{
    public function findByNombre($pagina = 1)
    {
        $query = $this->createQueryBuilder('c')
            ->orderBy('c.nombre', 'ASC')
            ->getQuery()
        ;

        return $this->creaPaginador($query, $pagina);
    }

    public function searchByNombreTutor($pagina= 1,$nombre,$tutor){
        $query = $this->createQueryBuilder('c')
            ->where('c.nombre LIKE :nombre AND c.nombreTutor LIKE :tutor')
            ->setParameter('nombre','%'.$nombre.'%')
            ->setParameter('tutor','%'.$tutor.'%')
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