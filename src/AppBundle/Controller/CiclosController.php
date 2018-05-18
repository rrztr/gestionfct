<?php
/**
 * Created by PhpStorm.
 * User: Rafa
 * Date: 28/02/2018
 * Time: 17:00
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Ciclos;
use AppBundle\Form\CiclosType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;


/**
 * Class CiclosController
 * @package AppBundle\Controller
 * @Route("/ciclos")
 */
class CiclosController extends Controller
{
    private $session;

    /**
     * CiclosController constructor.
     */
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
        $pag = $request->query->getInt('pag', 1);
        $ciclos = $this->getDoctrine()->getRepository(Ciclos::class)->findByNombre($pag);

        return $this->render("@App/view_ciclos/ciclos.html.twig",array(
            "ciclos" => $ciclos
        ));
    }

    /**
     * @param Request $request
     * @return mixed
     * @Route("/agregar")
     */
    public function registroCiclosAction(Request $request){

        $ciclo = new Ciclos();
        $form = $this->createForm(CiclosType::class,$ciclo);
        $form->handleRequest($request);

        if($form->isSubmitted() and $form->isValid()){
            $ciclo = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($ciclo);
            $flush = $em->flush();
            if($flush==null){
                $this->addFlash(
                    'success',
                    'Se ha guardado correctamente'
                );
                return $this->redirectToRoute("app_ciclos_index");
            }
            else{
                $error = "No se ha podido registrar";
                $this->session->getFlashBag()->add("error",$error);
            }
        }

        return $this->render("@App/view_ciclos/view_anadir_ciclo.html.twig", array("form" => $form->createView()
        ));
    }

    /**
     * @param Request $request
     * @param Ciclos $ciclo
     * @return mixed
     * @Route("/eliminar/{id}")
     */
    public function eliminaCiclosAction(Request $request,Ciclos $ciclo){
        $em = $this->getDoctrine()->getManager();
        $em->getRepository("AppBundle:Ciclos");

        if($request->isMethod("POST")){
            $em->remove($ciclo);
            $flush = $em->flush();
            if($flush==null){
                $this->addFlash(
                    'danger',
                    'Se ha eliminado el registro correctamente.'
                );
                return $this->redirectToRoute("app_ciclos_index");
            }
        }
        return $this->render("@App/view_ciclos/delete_ciclos.html.twig",
            array("ciclo" => $ciclo));
    }

    /**
     * @param Request $request
     * @param Ciclos $ciclo
     * @return mixed
     * @Route("/editar/{id}")
     */
    public function editarCiclosAction(Request $request,Ciclos $ciclo){
        $em = $this->getDoctrine()->getManager();
        $em->getRepository("AppBundle:Ciclos");

        $form = $this->createForm(CiclosType::class, $ciclo);
        $form->handleRequest($request);

        if($form->isSubmitted() and $form->isValid()){
            $ciclo = $form->getData();
            $em->persist($ciclo);
            $flush = $em->flush();
            if($flush==null)
            {
                $this->addFlash(
                    'success',
                    'Se ha actualizado correctamente'
                );
                return $this->redirectToRoute("app_ciclos_index");
            }
            else
            {
                $error= " No se ha podido actualizar";
                $this->session->getFlashBag()->add("error",$error);
            }
        }
        return $this->render("@App/view_ciclos/editar_ciclo.html.twig", array("form" => $form->createView()
        ));
    }

}