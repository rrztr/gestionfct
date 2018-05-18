<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Doctrine\Common\Collections\ArrayCollection;



/**
 * Alumnos
 *
 * @ORM\Table(name="alumnos", uniqueConstraints={@ORM\UniqueConstraint(name="alumnos_nif_uindex", columns={"nif"}), @ORM\UniqueConstraint(name="alumnos_email_uindex", columns={"email"})}, indexes={@ORM\Index(name="alumnos_ciclos_id_fk", columns={"ciclo_id"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AlumnoRepository")
 * @UniqueEntity("nif",message="El NIF introducido ya está en uso.")
 * @UniqueEntity("email",message="El e-mail introducido ya está en uso.")
 * @Vich\Uploadable
 */
class Alumnos
{
    /**
     * @var string
     * @Assert\Regex(
     *     pattern="/^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKE]/",
     *     message="Introduzca un NIF válido"
     * )
     * @Assert\NotBlank(
     *     message="Este campo no puede estar vacio."
     * )
     * @Assert\Length(
     *     min=9,
     *     max=9,
     *     exactMessage="El NIF debe tener una longitud de 9 caracteres",
     * )
     * @ORM\Column(name="nif", type="string", length=9, nullable=false, unique=true)
     */
    private $nif;

    /**
     * @var string
     * @Assert\Length(
     *     min= 2,
     *     max = 50,
     *     minMessage="El nombre debe tener al menos {{ limit }} caracteres de longitud",
     *     maxMessage="El nombre no puede tener más de {{ limit }} caracteres de longitud",
     * )
     * @Assert\NotBlank(
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
     *     minMessage="El apellido debe tener al menos {{ limit }} caracteres de longitud",
     *     maxMessage="El apellido no puede tener más de {{ limit }} caracteres de longitud",
     * )
     * @Assert\NotBlank(
     *     message="Este campo no puede estar vacio."
     * )
     * @ORM\Column(name="apellido1", type="string", length=255, nullable=false)
     */
    private $apellido1;

    /**
     * @var string
     *     @Assert\Length(
     *     min= 2,
     *     max = 50,
     *     minMessage="El apellido debe tener al menos {{ limit }} caracteres de longitud",
     *     maxMessage="El apellido no puede tener más de {{ limit }} caracteres de longitud",
     * )
     * @ORM\Column(name="apellido2", type="string", length=255, nullable=false)
     * @Assert\NotBlank(
     *     message="Este campo no puede estar vacio."
     * )
     */
    private $apellido2;

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
     * @var string
     * @Assert\Regex(
     *     pattern="/0[1-9][0-9]{3}|[1-4][0-9]{4}|5[0-2][0-9]{3}/",
     *     message="Introduzca un código postal válido",
     *     )
     * @Assert\Length(min= 5,max = 5,exactMessage="El CP debe tener 5 digitos")
     * @ORM\Column(name="codigopostal", type="integer", nullable=true)
     */
    private $codigopostal;

    /**
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
     * @Assert\Length(min= 9,max = 9,exactMessage="El teléfono debe tener 9 números")
     * @ORM\Column(name="tlf_fijo", type="string", length=255, nullable=true)
     */
    private $tlfFijo;

    /**
     * @var string
     * @Assert\Regex(
     *     pattern="/^[6|7][0-9]{8}/",
     *     message="Introduzca un teléfono móvil válido",
     *     )
     * @Assert\Length(min= 9,max = 9,exactMessage="El teléfono debe tener 9 números")
     * @ORM\Column(name="tlf_movil", type="string", length=255, nullable=true)
     */
    private $tlfMovil;

    /**
     * @var string
     * @Assert\Email(
     *     message="El email introducido ( {{ value }} ) no es un e-mail válido",
     *     checkMX = true,
     *     )
     * @Assert\NotBlank(
     *     message="Este campo no puede estar vacio."
     * )
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var string
     * @ORM\Column(name="fotografia", type="string", length=255, nullable=true)
     */
    private $fotografia;

    /**
     * @Vich\UploadableField(mapping="alumnos_image", fileNameProperty="fotografia")
     * @Assert\Image()
     */
    private $fichero;

    /**
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $updateAt;


    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Ciclos
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Ciclos", inversedBy="alumnos")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank(
     *     message="Este campo no puede estar vacio."
     * )
     */
    private $ciclo;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Fct", mappedBy="alumno")
     */
    private $fct;

    public function __construct() {
        $this->fct = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getNif()
    {
        return $this->nif;
    }

    /**
     * @param string $nif
     */
    public function setNif($nif)
    {
        $this->nif = $nif;
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
    public function getApellido1()
    {
        return $this->apellido1;
    }

    /**
     * @param string $apellido1
     */
    public function setApellido1($apellido1)
    {
        $this->apellido1 = $apellido1;
    }

    /**
     * @return string
     */
    public function getApellido2()
    {
        return $this->apellido2;
    }

    /**
     * @param string $apellido2
     */
    public function setApellido2($apellido2)
    {
        $this->apellido2 = $apellido2;
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
     * @return Ciclos
     */
    public function getCiclo()
    {
        return $this->ciclo;
    }

    /**
     * @param Ciclos $ciclo
     */
    public function setCiclo($ciclo)
    {
        $this->ciclo = $ciclo;
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
        $fct->setAlumno($this);
    }

    public function removeFct($fct)
    {
        $this->fct->removeElement($fct);
        $fct->setAlumno(null);
    }

    /**
     * @return string
     */
    public function getFotografia()
    {
        return $this->fotografia;
    }

    /**
     * @param string $fotografia
     */
    public function setFotografia($fotografia)
    {
        $this->fotografia = $fotografia;
    }

    /**
     * @return mixed
     */
    public function getFichero()
    {
        return $this->fichero;
    }

    /**
     * @param File|null $image
     * @internal param mixed $fichero
     */
    public function setFichero($image = null)
    {
        $this->fichero = $image;

        if (null !== $image) {
            $this->updateAt = new \DateTimeImmutable();
        }
    }

    public function __toString()
    {
        return $this->nombre . ' ' . $this->apellido1 . ' ' . $this->apellido2;
    }
}

