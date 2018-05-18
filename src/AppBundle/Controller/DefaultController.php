<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */

    public function indexAction(){
        return $this->render('@App/Default/index.html.twig');
    }


    /**
     * @Route("/login",name="login")
     */
    public function loginAction(){
        return $this->render("@App/Default/view_login.html.twig");
    }

    /**
     * @Route("/index_profesores",name="index_profesores")
     */
    public function indexProfesoresAction(){
        return $this->render("@App/Default/index_profesores.html.twig");
    }

    /**
     * @Route("/index_alumnos",name="index_alumnos")
     */
    public function indexAlumnosAction(){
        return $this->render("@App/Default/index_alumnos.html.twig");
    }

    /**
     * @Route("/index_empresas",name="index_empresas")
     */
    public function indexEmpresasAction(){
        return $this->render("@App/Default/index_empresas.html.twig");
    }

    /**
     * @Route("/index_ciclos",name="index_ciclos")
     */
    public function indexCiclosAction(){
        return $this->render("@App/Default/index_ciclos.html.twig");
    }

    /**
     * @Route("/index_fct",name="index_fct")
     */
    public function indexFctAction(){
        return $this->render("@App/Default/index_fct.html.twig");
    }

}


