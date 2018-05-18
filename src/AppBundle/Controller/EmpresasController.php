<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Empresas;
use AppBundle\Form\EmpresasType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Class EmpresasController
 * @package AppBundle\Controller
 * @Route("/empresas")
 */
class EmpresasController extends Controller
{
    private $session;

    /**
     * EmpresasController constructor.
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
        $pag = $request->query->getInt('pag',1);
        $nombre = $request->query->get('q');
        $tutor = $request->query->get('t');

        if($nombre || $tutor){
            $empresas = $this->getDoctrine()->getRepository(Empresas::class)->searchByNombreTutor($pag,$nombre,$tutor);
        }
        else{
            $empresas = $this->getDoctrine()->getRepository(Empresas::class)->findByNombre($pag);
        }

        return $this->render("@App/view_empresas/empresas.html.twig",array(
            "empresas" => $empresas
        ));
    }

    /**
     * @param Request $request
     * @return mixed
     * @Route("/agregar")
     */
    public function registroEmpresasAction(Request $request){
        $empresa = new Empresas();
        $form = $this->createForm(EmpresasType::class, $empresa);

        $form->handleRequest($request);
        if($form->isSubmitted() and $form->isValid()){
            $empresa = $form->getData();
                $em = $this->getDoctrine()->getManager();
                $em->persist($empresa);
                $flush = $em->flush();
                if ($flush == null) {
                    $this->addFlash(
                        'success',
                        'Se ha guardado correctamente'
                    );
                    return $this->redirectToRoute("app_empresas_index");

                } else {
                    $error = "No se ha podido registrar";
                    $this->session->getFlashBag()->add("error", $error);
                }
            }
            return $this->render("@App/view_empresas/view_anadir_empresa.html.twig", array(
            "form" => $form->createView()
        ));
    }

    /**
     * @param Request $request
     * @param Empresas $empresa
     * @return mixed
     * @Route("/eliminar/{id}")
     */
    public function eliminaEmpresasAction(Request $request,Empresas $empresa){
        $em = $this->getDoctrine()->getManager();
        $em->getRepository("AppBundle:Empresas");

        if($request->isMethod("POST")){
            $em->remove($empresa);
            $flush = $em->flush();
            if($flush==null)
            {
                $this->addFlash(
                    'danger',
                    'Se ha eliminado el registro correctamente.'
                );
                return $this->redirectToRoute("app_empresas_index");
            }
        }
        return $this->render("@App/view_empresas/delete_empresa.html.twig",
            array("empresa" => $empresa));

    }

    /**
     * @param Request $request
     * @param Empresas $empresa
     * @return mixed
     * @Route("/{id}")
     */
    public function muestraEmpresasAction(Request $request,Empresas $empresa){
        $em = $this->getDoctrine()->getManager();
        $em->getRepository("AppBundle:Empresas");

        return $this->render("@App/view_empresas/mostrar_empresas.html.twig",
            array("empresa" => $empresa));
    }

    /**
     * @param Request $request
     * @param Empresas $empresa
     * @return mixed
     * @Route("/editar/{id}")
     */
    public function editarEmpresasAction(Request $request,Empresas $empresa){
        $em = $this->getDoctrine()->getManager();
        $em->getRepository("AppBundle:Empresas");

        $form = $this->createForm(EmpresasType::class, $empresa);
        $form->handleRequest($request);

        if($form->isSubmitted() and $form->isValid()){
            $empresa = $form->getData();
            $em->persist($empresa);
            $flush = $em->flush();
            if($flush==null)
            {
                $this->addFlash(
                    'success',
                    'Se ha actualizado correctamente'
                );
                return $this->redirectToRoute("app_empresas_index");
            }
            else
            {
                $error= " No se ha podido actualizar";
                $this->session->getFlashBag()->add("error",$error);
            }
        }
        return $this->render("@App/view_empresas/editar_empresas.html.twig", array("form" => $form->createView()
        ));
    }
}
