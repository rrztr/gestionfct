<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Ciclos
 *
 * @ORM\Table(name="ciclos", uniqueConstraints={@ORM\UniqueConstraint(name="ciclos_codigo_uindex", columns={"codigo"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CicloRepository")
 * @UniqueEntity("codigo",message="Ese código ya está en uso")
 */
class Ciclos
{
    /**
     * @var string
     * @Assert\NotBlank(
     *     message="Este campo no puede estar vacio."
     * )
     * @Assert\Length(
     *     min= 2,
     *     max = 5,
     *     minMessage="El código debe tener al menos {{ limit }} caracteres de longitud",
     *     maxMessage="El código no puede tener más de {{ limit }} caracteres de longitud",
     * )
     * @ORM\Column(name="codigo", type="string", length=20, nullable=false)
     */
    private $codigo;

    /**
     * @var string
     * @Assert\NotBlank(
     *     message="Este campo no puede estar vacio."
     * )
     * @Assert\Length(
     *     min= 2,
     *     max = 50,
     *     minMessage="El nombre debe tener al menos {{ limit }} caracteres de longitud",
     *     maxMessage="El nombre no puede tener más de {{ limit }} caracteres de longitud",
     * )
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     * @Assert\NotBlank(
     *     message="Este campo no puede estar vacio."
     * )
     * @ORM\Column(name="grado", type="string", length=255, nullable=false)
     */
    private $grado;

    /**
     * @var integer
     * * @Assert\Regex(
     *     pattern="/^[0-9]+/",
     *     message="Introduzca un número de horas válidas."
     * )
     * @ORM\Column(name="horasfct", type="integer", nullable=false)
     */
    private $horasfct;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Alumnos",mappedBy="ciclo",cascade={"persist","remove"})
     */
    private $alumnos;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Profesores", mappedBy="ciclos",cascade={"persist","remove"})
     */
    private $profesores;


    /**
     * @return string
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * @param string $codigo
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    }

    /**
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return string
     */
    public function getGrado()
    {
        return $this->grado;
    }

    /**
     * @param string $grado
     */
    public function setGrado($grado)
    {
        $this->grado = $grado;
    }

    /**
     * @return int
     */
    public function getHorasfct()
    {
        return $this->horasfct;
    }

    /**
     * @param int $horasfct
     */
    public function setHorasfct($horasfct)
    {
        $this->horasfct = $horasfct;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getAlumnos()
    {
        return $this->alumnos;
    }

    /**
     * @param mixed $alumnos
     */
    public function setAlumnos($alumnos)
    {
        $this->alumnos = $alumnos;
    }

    /**
     * @return mixed
     */
    public function getProfesores()
    {
        return $this->profesores;
    }

    public function addProfesor(...$profesores)
    {
        foreach($profesores as $profesor){
            if(!$this->profesores->contains($profesor)){
                $this->profesores->add($profesor);
            }
        }
    }

    public function removeCiclo($profesor)
    {
        $this->profesores->removeElement($profesor);
    }
}

