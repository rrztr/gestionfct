<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Fct;
use AppBundle\Form\FctType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * @Route("/fct")
 */

class FctController extends Controller
{
    private $session;

    /**
     * FctController constructor.
     */
    public function __construct()
    {
        $this->session=new Session();
    }

    /**
     * @param Request $request
     * @return mixed
     * @Route("/",name="indexfct")
     */
    public function indexAction(Request $request){
        $pag = $request->query->getInt('pag', 1);
        $alumno = $request->query->get('a');
        $profesor = $request->query->get('p');
        $ciclo = $request->query->get('c');

        if($alumno|| $profesor || $ciclo){
            $fct = $this->getDoctrine()->getRepository(Fct::class)->searchByNombreCiclo($pag,$alumno,$profesor,$ciclo);
        }
        else{
            $fct = $this->getDoctrine()->getRepository(Fct::class)->findByAnyo($pag);
        }

        return $this->render("@App/view_fct/fct.html.twig",array(
            "fct" => $fct
        ));
    }

    /**
     * @param Request $request
     * @return mixed
     * @Route("/agregar")
     */
    public function registroFctAction(Request $request)
    {
        $fct = new Fct();
        $form = $this->createForm(FctType::class, $fct);

        $form->handleRequest($request);

        if($form->isSubmitted() and $form->isValid()){

            $alumno = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($fct);
            $flush = $em->flush();

            if($flush==null)
            {
                $this->addFlash(
                    'success',
                    'Se ha guardado correctamente'
                );
                return $this->redirectToRoute("indexfct");
            }
            else
            {
                $error= " No se ha podido registrar";
                $this->session->getFlashBag()->add("error",$error);
            }
        }

        return $this->render("@App/view_fct/view_anadir_fct.html.twig", array("form" => $form->createView()
        ));
    }

    /**
     * @param Request $request
     * @param Fct $fct
     * @return mixed
     * @Route("/eliminar/{id}")
     */
    public function eliminaFctAction(Request $request,Fct $fct){
        $em = $this->getDoctrine()->getManager();
        $em->getRepository("AppBundle:Fct");

        if($request->isMethod("POST")){
            $em->remove($fct);
            $flush = $em->flush();
            if($flush==null){
                $this->addFlash(
                    'danger',
                    'Se ha eliminado el registro correctamente.'
                );
                return $this->redirectToRoute("indexfct");
            }
        }
        return $this->render("@App/view_fct/delete_fct.html.twig",
        array("fct" => $fct));
    }

    /**
     * @param Request $request
     * @param Fct $fct
     * @return mixed
     * @Route("/editar/{id}")
     */
    public function editarFctAction(Request $request,Fct $fct){
        $em = $this->getDoctrine()->getManager();
        $em->getRepository("AppBundle:Fct");

        $form = $this->createForm(FctType::class, $fct);
        $form->handleRequest($request);

        if($form->isSubmitted() and $form->isValid()){
            $fct = $form->getData();
            $em->persist($fct);
            $flush = $em->flush();
            if($flush==null)
            {
                $this->addFlash(
                    'success',
                    'Se ha actualizado correctamente'
                );
                return $this->redirectToRoute("indexfct");
            }
            else
            {
                $error= " No se ha podido actualizar";
                $this->session->getFlashBag()->add("error",$error);
            }
        }
        return $this->render("@App/view_fct/editar_fct.html.twig", array("form" => $form->createView()
        ));
    }

}
