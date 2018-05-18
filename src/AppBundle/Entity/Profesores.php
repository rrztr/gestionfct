<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;



/**
 * Profesores
 *
 * @ORM\Table(name="profesores", uniqueConstraints={@ORM\UniqueConstraint(name="profesores_username_uindex", columns={"username"}), @ORM\UniqueConstraint(name="profesores_email_uindex", columns={"email"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProfesorRepository")
 * @UniqueEntity("email",message="El e-mail introducido ya está en uso.")
 * @UniqueEntity("username",message="El nombre de usuario introducido ya está registrado.")
 * @Vich\Uploadable
 */
class Profesores
{
    /**
     * @var string
     *     @Assert\Length(
     *     min= 2,
     *     max = 50,
     *     minMessage="El apellido debe tener al menos {{ limit }} caracteres de longitud",
     *     maxMessage="El apellido no puede tener más de {{ limit }} caracteres de longitud",
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
     *     minMessage="El apellido debe tener al menos {{ limit }} caracteres de longitud",
     *     maxMessage="El apellido no puede tener más de {{ limit }} caracteres de longitud",
     * )
     * @ORM\Column(name="apellido1", type="string", length=255, nullable=true)
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
     * @ORM\Column(name="apellido2", type="string", length=255, nullable=true)
     */
    private $apellido2;

    /**
     * @var string
     * @ORM\Column(name="fotografia", type="string", length=255, nullable=true)
     */
    private $fotografia;

    /**
     * @Vich\UploadableField(mapping="profesores_image", fileNameProperty="fotografia")
     * @Assert\Image()
     */
    private $fichero;

    /**
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $updateAt;


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
     *     @Assert\Length(
     *     min= 2,
     *     max = 16,
     *     minMessage="El nombre de usuario debe tener al menos {{ limit }} caracteres de longitud",
     *     maxMessage="nombre de usuario no puede tener más de {{ limit }} caracteres de longitud",
     * )
     *  @Assert\NotBlank(
     *     message="Este campo no puede estar vacio."
     * )
     * @ORM\Column(name="username", type="string", length=255, nullable=false)
     */
    private $username;

    /**
     * @var string
     * @Assert\Email(
     *     message="El email introducido ( {{ value }} ) no es un e-mail válido",
     *     checkMX = true,
     *     )
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="rol", type="string", length=255, nullable=false)
     *     @Assert\NotBlank(
     *     message="Tiene que escoger un rol."
     * )
     */
    private $rol;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Ciclos", inversedBy="profesores")
     * @ORM\JoinTable(name="ciclos_prof")
     */
    private $ciclos;

    public function __construct() {
        $this->fct = new ArrayCollection();
        $this->ciclos = new ArrayCollection();
    }

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Fct", mappedBy="profesor",cascade={"persist","remove"})
     */
    private $fct;

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
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
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
     * @return string
     */
    public function getRol()
    {
        return $this->rol;
    }

    /**
     * @param string $rol
     */
    public function setRol($rol)
    {
        $this->rol = $rol;
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
        $fct->setProfesor($this);
    }

    public function removeFct($fct)
    {
        $this->fct->removeElement($fct);
        $fct->setProfesor(null);
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

    /**
     * @return mixed
     */
    public function getCiclos()
    {
        return $this->ciclos;
    }

    public function addCiclo(...$ciclos)
    {
        foreach($ciclos as $ciclo){
            if(!$this->ciclos->contains($ciclo)){
                $this->ciclos->add($ciclo);
            }
        }
    }

    public function removeCiclo(Ciclos $ciclo)
    {
        $this->ciclos->removeElement($ciclo);
    }

    public function __toString()
    {
        return $this->nombre . ' ' . $this->apellido1 . ' ' . $this->apellido2;
    }
}

