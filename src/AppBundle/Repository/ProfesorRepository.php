<?php
/**
 * Created by PhpStorm.
 * User: Rafa
 * Date: 27/02/2018
 * Time: 1:40
 */

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;


class ProfesorRepository extends EntityRepository
{
    public function findByNombre($pagina = 1)
    {
        $query = $this->createQueryBuilder('c')
            ->orderBy('c.nombre', 'ASC')
            ->getQuery()
        ;
        return $this->creaPaginador($query, $pagina);
    }

    public function searchByNombreRol($pagina= 1,$nombre,$rol){
        $query = $this->createQueryBuilder('c')
            ->where('c.nombre LIKE :nombre AND c.rol LIKE :rol')
            ->setParameter('nombre','%'.$nombre.'%')
            ->setParameter('rol','%'.$rol.'%')
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