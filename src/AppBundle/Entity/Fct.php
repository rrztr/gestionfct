<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Fct
 *
 * @ORM\Table(name="fct", indexes={@ORM\Index(name="fct_alumnos_id_fk", columns={"alumno_id"}), @ORM\Index(name="fct_empresas_id_fk", columns={"empresas_id"}), @ORM\Index(name="fct_profesores_id_fk", columns={"profesor_id"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FctRepository")
 */
class Fct
{
    /**
     * @var string
     *
     * @ORM\Column(name="anyo", type="string", length=255, nullable=false)
     * @Assert\NotBlank(
     *     message="Este campo no puede estar vacio."
     * )
     */
    private $anyo;

    /**
     * @var string
     *
     * @ORM\Column(name="periodo", type="string", length=255, nullable=false)
     * @Assert\NotBlank(
     *     message="Este campo no puede estar vacio."
     * )
     */
    private $periodo;


    /**
     * @ORM\Column(name="cod_ciclo",type="string",length=255,nullable=false)
     *     @Assert\Length(
     *     min= 2,
     *     max = 5,
     *     minMessage="El código del ciclo debe tener al menos {{ limit }} caracteres de longitud",
     *     maxMessage="El código del ciclo no puede tener más de {{ limit }} caracteres de longitud",
     * )
     */
    private $cod_ciclo;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Alumnos
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Alumnos")
     * @Assert\NotBlank(
     *     message="Este campo no puede estar vacio."
     * )
     */
    private $alumno;

    /**
     * @var \AppBundle\Entity\Empresas
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Empresas")
     * @Assert\NotBlank(
     *     message="Este campo no puede estar vacio."
     * )
     */
    private $empresas;

    /**
     * @var \AppBundle\Entity\Profesores
     * @Assert\NotBlank(
     *     message="Este campo no puede estar vacio."
     * )
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Profesores")
     */
    private $profesor;

    /**
     * @return string
     */
    public function getAnyo()
    {
        return $this->anyo;
    }

    /**
     * @param string $anyo
     */
    public function setAnyo($anyo)
    {
        $this->anyo = $anyo;
    }

    /**
     * @return string
     */
    public function getPeriodo()
    {
        return $this->periodo;
    }

    /**
     * @param string $periodo
     */
    public function setPeriodo($periodo)
    {
        $this->periodo = $periodo;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Alumnos
     */
    public function getAlumno()
    {
        return $this->alumno;
    }

    /**
     * @param Alumnos $alumno
     */
    public function setAlumno($alumno)
    {
        $this->alumno = $alumno;
    }

    /**
     * @return Empresas
     */
    public function getEmpresas()
    {
        return $this->empresas;
    }

    /**
     * @param Empresas $empresas
     */
    public function setEmpresas($empresas)
    {
        $this->empresas = $empresas;
    }

    /**
     * @return Profesores
     */
    public function getProfesor()
    {
        return $this->profesor;
    }

    /**
     * @param Profesores $profesor
     */
    public function setProfesor($profesor)
    {
        $this->profesor = $profesor;
    }

    /**
     * @return mixed
     */
    public function getCodCiclo()
    {
        return $this->cod_ciclo;
    }

    /**
     * @param mixed $cod_ciclo
     */
    public function setCodCiclo($cod_ciclo)
    {
        $this->cod_ciclo = $cod_ciclo;
    }

}

