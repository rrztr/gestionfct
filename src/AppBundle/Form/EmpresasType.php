<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;

class EmpresasType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('cif',TextType::class,array("label"=>"CIF","required"=>"required"))
            ->add('nombre',TextType::class,array("label"=>"Nombre de la empresa","required"=>"required"))
            ->add('nombreTutor',TextType::class,array("label"=>"Nombre del tutor","required"=>"required"))
            ->add('direccion',TextType::class,array("label"=>"Dirección"))
            ->add('poblacion',TextType::class,array("label"=>"Población"))
            ->add('codigopostal',TextType::class,array("label"=>"Código Postal"))
            ->add('provincia',ChoiceType::class,array("label"=>"Rol","placeholder"=>"Elija provincia",
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
            ->add('email',TextType::class,array("label"=>"Correo electrónico","required"=>"required"))
            ->add('Guardar',SubmitType::class,array("attr"=>array(
                "class"=>"form-submit btn btn-success",)));


    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Empresas'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_empresas';
    }


}
