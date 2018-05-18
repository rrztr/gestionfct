<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class AlumnosType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nif',TextType::class,array("label"=>"NIF"))
        ->add('nombre',TextType::class,array("label"=>"Nombre"))
        ->add('apellido1',TextType::class,array("label"=>"1er apellido"))
        ->add('apellido2',TextType::class,array("label"=>"2do apellido"))
        ->add('direccion',TextType::class,array("label"=>"Dirección"))
        ->add('poblacion',TextType::class,array("label"=>"Población"))
        ->add('codigopostal',TextType::class,array("label"=>"Código postal"))
        ->add('provincia',ChoiceType::class,array("label"=>"Provincia","placeholder"=>"Elija provincia",
                "choices" => array(
                    'Alava'=>'Alava',
                    'Albacete'=>'Albacete',
                    'Alicante'=>'Alicante',
                    'Almería'=>'Almería',
                    'Asturias'=>'Asturias',
                    'Avila'=>'Avila',
                    'Badajoz'=>'Badajoz',
                    'Barcelona'=>'Barcelona',
                    'Burgos'=>'Burgos',
                    'Cáceres'=>'Cáceres',
                    'Cádiz'=>'Cádiz',
                    'Cantabria'=>'Cantabria',
                    'Castellón'=>'Castellón',
                    'Ciudad Real'=>'Ciudad Real',
                    'Córdoba'=>'Córdoba',
                    'La Coruña'=>'La Coruña',
                    'Cuenca'=>'Cuenca',
                    'Girona'=>'Girona',
                    'Granada'=>'Granada',
                    'Guadalajara'=>'Guadalajara',
                    'Guipúzcoa'=>'Guipúzcoa',
                    'Huelva'=>'Huelva',
                    'Huesca'=>'Huesca',
                    'Islas Baleares'=>'Islas Baleares',
                    'Jaén'=>'Jaén',
                    'León'=>'León',
                    'Lérida'=>'Lérida',
                    'Lugo'=>'Lugo',
                    'Madrid'=>'Madrid',
                    'Málaga'=>'Málaga',
                    'Murcia'=>'Murcia',
                    'Navarra'=>'Navarra',
                    'Orense'=>'Orense',
                    'Palencia'=>'Palencia',
                    'Las Palmas'=>'Las Palmas',
                    'Pontevedra'=>'Pontevedra',
                    'La Rioja'=>'La Rioja',
                    'Salamanca'=>'Salamanca',
                    'Segovia'=>'Segovia',
                    'Sevilla'=>'Sevilla',
                    'Soria'=>'Soria',
                    'Tarragona'=>'Tarragona',
                    'Santa Cruz' =>'Santa Cruz de Tenerife',
                    'Teruel'=>'Teruel',
                    'Toledo'=>'Toledo',
                    'Valencia'=>'Valencia',
                    'Valladolid'=>'Valladolid',
                    'Vizcaya'=>'Vizcaya',
                    'Zamora'=>'Zamora',
                    'Zaragoza'=>'Zaragoza',
                )))
        ->add('tlfFijo',TextType::class,array("label"=>"Teléfono fijo"))
        ->add('tlfMovil',TextType::class,array("label"=>"Teléfono móvil"))
        ->add('email',TextType::class,array("label"=>"Correo electrónico"))
        ->add('fichero',FileType::class,array("label"=>"Fotografía"))
        ->add('ciclo',EntityType::class, array(
                'class' => 'AppBundle:Ciclos',
                "placeholder"=>"Elija un ciclo",
                'choice_label' => 'nombre'
                ))
        ->add('Guardar',SubmitType::class,array("attr"=>array(
        "class"=>"form-submit btn btn-success",)));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Alumnos'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_alumnos';
    }


}
