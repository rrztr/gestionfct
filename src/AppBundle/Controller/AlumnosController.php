<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Alumnos;
use AppBundle\Form\AlumnosType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;


/**
 * Class AlumnosController
 * @package AppBundle\Controller
 * @Route("/alumnos")
 */

class AlumnosController extends Controller
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
        $pag = $request->query->getInt('pag', 1);
        $nombre = $request->query->get('q');
        $ciclo = $request->query->get('c');

        if($nombre || $ciclo){
            $alumnos = $this->getDoctrine()->getRepository(Alumnos::class)->searchByNombreCiclo($pag,$nombre,$ciclo);
        }
        else{
            $alumnos = $this->getDoctrine()->getRepository(Alumnos::class)->findByCiclo($pag);
        }
        return $this->render("@App/view_alumnos/alumnos.html.twig",array(
            "alumnos" => $alumnos
        ));
    }

    /**
     * @param Request $request
     * @return mixed
     * @Route("/agregar")
     */
    public function registroAlumnosAction(Request $request)
    {
        $alumno = new Alumnos();
        $form = $this->createForm(AlumnosType::class, $alumno);

        $form->handleRequest($request);

        if($form->isSubmitted() and $form->isValid()){

            $alumno = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($alumno);
            $flush = $em->flush();

            if($flush==null)
            {
                $this->addFlash(
                    'success',
                    'Se ha guardado correctamente'
                );
                return $this->redirectToRoute("app_alumnos_index");
            }
            else
            {
                $error= " No se ha podido registrar";
                $this->session->getFlashBag()->add("error",$error);
            }
        }

        return $this->render("@App/view_alumnos/view_anadir_alumno.html.twig", array("form" => $form->createView()
        ));
    }

    /**
     * @param Request $request
     * @param Alumnos $alumno
     * @return mixed
     * @Route("/eliminar/{id}")
     */
    public function eliminaAlumnosAction(Request $request,Alumnos $alumno){
        $em = $this->getDoctrine()->getManager();
        $em->getRepository("AppBundle:Alumnos");

        if($request->isMethod("POST")){
            $em->remove($alumno);
            $flush = $em->flush();
            if($flush==null){
                $this->addFlash(
                    'danger',
                    'Se ha eliminado el registro correctamente.'
                );
                return $this->redirectToRoute("app_alumnos_index");
            }
        }
        return $this->render("@App/view_alumnos/delete_alumno.html.twig",
            array("alumno" => $alumno));

    }

    /**
     * @param Request $request
     * @param Alumnos $alumno
     * @return mixed
     * @Route("/{id}")
     */
    public function muestraAlumnosAction(Request $request,Alumnos $alumno){
        $em = $this->getDoctrine()->getManager();
        $em->getRepository("AppBundle:Alumnos");

        return $this->render("@App/view_alumnos/mostrar_alumnos.html.twig",
            array("alumno" => $alumno));
    }

    /**
     * @param Request $request
     * @param Alumnos $alumno
     * @return mixed
     * @Route("/editar/{id}")
     */
    public function editarAlumnosAction(Request $request,Alumnos $alumno){
        $em = $this->getDoctrine()->getManager();
        $em->getRepository("AppBundle:Alumnos");

        $form = $this->createForm(AlumnosType::class, $alumno);
        $form->handleRequest($request);

        if($form->isSubmitted() and $form->isValid()){
            $alumno = $form->getData();
                $em->persist($alumno);
                $flush = $em->flush();
                if($flush==null)
                {
                    $this->addFlash(
                        'success',
                        'Se ha actualizado correctamente'
                    );
                    return $this->redirectToRoute("app_alumnos_index");
                }
                else
                {
                    $error= " No se ha podido actualizar";
                    $this->session->getFlashBag()->add("error",$error);
                }
            }
        return $this->render("@App/view_alumnos/editar_alumnos.html.twig", array("form" => $form->createView()
        ));
    }

    /**
     * @param Request $request
     * @param Alumnos $alumno
     * @Route("/pdf/{id}",name="pdf_alumno")
     */
    public function pdfAlumnosAction(Request $request,Alumnos $alumno){
        $em = $this->getDoctrine()->getManager();
        $em->getRepository("AppBundle:Alumnos");

        $html= $this->renderView("@App/view_alumnos/pdf_alumnos.html.twig",
            array("alumno" => $alumno));
        $this->returnPDFResponseFromHTML($html);
    }

    /**
     * @param $html
     */
    public function returnPDFResponseFromHTML($html){

        $pdf = $this->get("white_october.tcpdf")->create('vertical', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetAuthor('Rafael Ruiz - DAW');
        $pdf->SetTitle(('Datos del alumno'));
        $pdf->SetSubject('Our Code World Subject');
        $pdf->SetFont('helvetica', '', 11, '', true);
        $pdf->AddPage();

        $filename = 'datos_alumno_pdf';

        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
        $pdf->Output($filename.".pdf",'I'); // This will output the PDF as a response directly
    }
}







