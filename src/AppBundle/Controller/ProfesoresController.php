<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Profesores;
use AppBundle\Form\ProfesoresType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Class ProfesoresController
 * @package AppBundle\Controller
 * @Route("/profesores")
 */
class ProfesoresController extends Controller
{
    private $session;

    public function __construct()
    {
        $this->session=new Session();
    }

    /**
     * @param Request $request
     * @return mixed
     * @Route("/")
     */
    public function indexAction(Request $request){
        $pag = $request->query->getInt('pag',1);
        $nombre = $request->query->get('q');
        $rol = $request->query->get('r');

        if($nombre || $rol){
            $profesores = $this->getDoctrine()->getRepository(Profesores::class)->searchByNombreRol($pag,$nombre,$rol);
        }
        else{
        $profesores = $this->getDoctrine()->getRepository(Profesores::class)->findByNombre($pag);
        }

        return $this->render("@App/view_profesores/profesores.html.twig",array(
            "profesores" => $profesores
        ));
    }

    /**
     * @param Request $request
     * @return mixed
     * @Route("/agregar")
     */
    public function registroProfesoresAction(Request $request)
    {
        $profesor = new Profesores();
        $form = $this->createForm(ProfesoresType::class, $profesor);

        $form->handleRequest($request);

        if($form->isSubmitted()){
            if ($form->isValid()) {
                $profesor = $form->getData();
                $em = $this->getDoctrine()->getManager();
                $em->persist($profesor);
                $flush = $em->flush();
                if ($flush == null) {
                    $this->addFlash(
                        'success',
                        'Se ha guardado correctamente'
                    );
                    return $this->redirectToRoute("app_profesores_index");


                } else {
                    $error = "No se ha podido registrar";
                    $this->session->getFlashBag()->add("error", $error);
                }
            }
            else {
                $error = "No se ha podido registrar";
                $this->session->getFlashBag()->add("error", $error);
            }
        }

        return $this->render("@App/view_profesores/view_anadir_profesor.html.twig", array(
            "form" => $form->createView()
        ));
    }

    /**
     * @param Request $request
     * @param Profesores $profesor
     * @return mixed
     * @Route("/eliminar/{id}")
     */
    public function eliminaProfesoresAction(Request $request,Profesores $profesor){
        $em = $this->getDoctrine()->getManager();
        $em->getRepository("AppBundle:Profesores");

        if($request->isMethod("POST")){
            $em->remove($profesor);
            $flush = $em->flush();
            if($flush==null)
            {
                $this->addFlash(
                    'danger',
                    'Se ha eliminado el registro correctamente.'
                );
                return $this->redirectToRoute("app_profesores_index");
            }
        }
        return $this->render("@App/view_profesores/delete_profesor.html.twig",
            array("profesor" => $profesor));

    }

    /**
     * @param Request $request
     * @param Profesores $profesor
     * @return mixed
     * @Route("/mostrar/{id}")
     */
    public function muestraProfesoresAction(Request $request,Profesores $profesor){
        $em = $this->getDoctrine()->getManager();
        $em->getRepository("AppBundle:Profesores");

        return $this->render("@App/view_profesores/mostrar_profesores.html.twig",
            array("profesor" => $profesor));
    }

    /**
     * @param Request $request
     * @param Profesores $profesor
     * @return mixed
     * @Route("/editar/{id}")
     */
    public function editarProfesoresAction(Request $request,Profesores $profesor){
        $em = $this->getDoctrine()->getManager();
        $em->getRepository("AppBundle:Profesores");

        $form = $this->createForm(ProfesoresType::class, $profesor);
        $form->handleRequest($request);

        if($form->isSubmitted() and $form->isValid()){
            $profesor = $form->getData();
            $em->persist($profesor);
            $flush = $em->flush();
            if($flush==null)
            {
                $this->addFlash(
                    'success',
                    'Se ha actualizado correctamente'
                );
                return $this->redirectToRoute("app_profesores_index");
            }
            else
            {
                $error= " No se ha podido actualizar";
                $this->session->getFlashBag()->add("error",$error);
            }
        }
        return $this->render("@App/view_profesores/editar_profesores.html.twig", array("form" => $form->createView()
        ));
    }
}
