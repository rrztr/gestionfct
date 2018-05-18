<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * Empresas
 *
 * @ORM\Table(name="empresas", uniqueConstraints={@ORM\UniqueConstraint(name="empresas_CIF_uindex", columns={"CIF"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EmpresaRepository")
 * @UniqueEntity("cif",message="El CIF está en uso")
 */
class Empresas
{

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Fct", mappedBy="empresas")
     */
    private $fct;

    /**
     * @var string
     * @Assert\Regex(
     *     pattern="/^([ABCDEFGHJKLMNPQRSUVW])(\d{7})([0-9A-J])$/",
     *     message="Introduzca un CIF válido",
     *     )
     *  @Assert\NotBlank(
     *     message="Este campo no puede estar vacio."
     * )
     * @ORM\Column(name="CIF", type="string", length=255, nullable=false)
     */
    private $cif;

    /**
     * @var string
     *     @Assert\Length(
     *     min= 2,
     *     max = 50,
     *     minMessage="El nombre debe tener al menos {{ limit }} caracteres de longitud",
     *     maxMessage="El nombre no puede tener más de {{ limit }} caracteres de longitud",
     * )
     *  @Assert\NotBlank(
     *     message="Este campo no puede estar vacio."
     * )
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *     @Assert\Length(
     *     min= 2,
     *     max = 50,
     *     minMessage="El nombre del tutor debe tener al menos {{ limit }} caracteres de longitud",
     *     maxMessage="El nombre del tutor no puede tener más de {{ limit }} caracteres de longitud",
     * )
     *  @Assert\NotBlank(
     *     message="Este campo no puede estar vacio."
     * )
     * @ORM\Column(name="nombre_tutor", type="string", length=255, nullable=false)
     */
    private $nombreTutor;

    /**
     * @var string
     *     @Assert\Length(
     *     min= 5,
     *     max = 100,
     *     minMessage="La dirección debe tener al menos {{ limit }} caracteres de longitud",
     *     maxMessage="La dirección no puede tener más de {{ limit }} caracteres de longitud",
     * )
     * @ORM\Column(name="direccion", type="string", length=255, nullable=true)
     */
    private $direccion;

    /**
     * @var string
     *     @Assert\Length(
     *     min= 2,
     *     max = 100,
     *     minMessage="La población debe tener al menos {{ limit }} caracteres de longitud",
     *     maxMessage="La población no puede tener más de {{ limit }} caracteres de longitud",
     * )
     * @ORM\Column(name="poblacion", type="string", length=255, nullable=true)
     */
    private $poblacion;

    /**
     * @var integer
     * @Assert\Regex(
     *     pattern="/0[1-9][0-9]{3}|[1-4][0-9]{4}|5[0-2][0-9]{3}/",
     *     message="Introduzca un código postal válido",
     *     )
     * @ORM\Column(name="codigopostal", type="integer", nullable=true)
     * @Assert\Length(min= 5,max = 5,exactMessage="El CP debe tener 5 digitos")
     */
    private $codigopostal;

    /**
     * @var string
     *     @Assert\Length(
     *     min= 2,
     *     max = 100,
     *     minMessage="La provincia debe tener al menos {{ limit }} caracteres de longitud",
     *     maxMessage="La provincia no puede tener más de {{ limit }} caracteres de longitud",
     * )
     * @ORM\Column(name="provincia", type="string", length=255, nullable=true)
     */
    private $provincia;

    /**
     * @var string
     * @Assert\Regex(
     *     pattern="/^[9|8][0-9]{8}/",
     *     message="Introduzca un teléfono fijo válido",
     *     )
     * @ORM\Column(name="tlf_fijo", type="string", length=255, nullable=true)
     * @Assert\Length(min= 9,max = 9,exactMessage="El teléfono debe tener 9 números")
     */
    private $tlfFijo;

    /**
     * @var string
     * @Assert\Regex(
     *     pattern="/^[6|7][0-9]{8}/",
     *     message="Introduzca un teléfono móvil válido",
     *     )
     * @ORM\Column(name="tlf_movil", type="string", length=255, nullable=true)
     * @Assert\Length(min= 9,max = 9,exactMessage="El teléfono debe tener 9 números")
     */
    private $tlfMovil;

    /**
     * @var string
     * @Assert\Email(
     *     message="El email introducido ( {{ value }} ) no es un e-mail válido",
     *     checkMX = true,
     *     )
     *  @Assert\NotBlank(
     *     message="Este campo no puede estar vacio."
     * )
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     *
     */
    private $id;

    public function __construct() {
        $this->fct = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getCif()
    {
        return $this->cif;
    }

    /**
     * @param int $cif
     */
    public function setCif($cif)
    {
        $this->cif = $cif;
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
    public function getNombreTutor()
    {
        return $this->nombreTutor;
    }

    /**
     * @param string $nombreTutor
     */
    public function setNombreTutor($nombreTutor)
    {
        $this->nombreTutor = $nombreTutor;
    }

    /**
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * @param string $direccion
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }

    /**
     * @return string
     */
    public function getPoblacion()
    {
        return $this->poblacion;
    }

    /**
     * @param string $poblacion
     */
    public function setPoblacion($poblacion)
    {
        $this->poblacion = $poblacion;
    }

    /**
     * @return int
     */
    public function getCodigopostal()
    {
        return $this->codigopostal;
    }

    /**
     * @param int $codigopostal
     */
    public function setCodigopostal($codigopostal)
    {
        $this->codigopostal = $codigopostal;
    }

    /**
     * @return string
     */
    public function getProvincia()
    {
        return $this->provincia;
    }

    /**
     * @param string $provincia
     */
    public function setProvincia($provincia)
    {
        $this->provincia = $provincia;
    }

    /**
     * @return string
     */
    public function getTlfFijo()
    {
        return $this->tlfFijo;
    }

    /**
     * @param string $tlfFijo
     */
    public function setTlfFijo($tlfFijo)
    {
        $this->tlfFijo = $tlfFijo;
    }

    /**
     * @return string
     */
    public function getTlfMovil()
    {
        return $this->tlfMovil;
    }

    /**
     * @param string $tlfMovil
     */
    public function setTlfMovil($tlfMovil)
    {
        $this->tlfMovil = $tlfMovil;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
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
    public function getFct()
    {
        return $this->fct;
    }

    public function addFct($fct)
    {
        if ($this->fct->contains($fct)) {
            return;
        }
        $this->fct[] = $fct;
        $fct->setEmpresas($this);
    }

    public function removeFct($fct)
    {
        $this->fct->removeElement($fct);
        $fct->setEmpresas(null);
    }

}

