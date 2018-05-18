<?php

namespace AppBundle\Form;

use AppBundle\AppBundle;
use AppBundle\Entity\Ciclos;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class ProfesoresType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nombre',TextType::class,array("label"=>"Nombre"))
            ->add('apellido1',TextType::class,array("label"=>"1er apellido"))
            ->add('apellido2',TextType::class,array("label"=>"2do apellido"))
            ->add('tlfFijo',TextType::class,array("label"=>"Teléfono fijo"))
            ->add('tlfMovil',TextType::class,array("label"=>"Teléfono móvil"))
            ->add('username',TextType::class,array("label"=>"Nombre de usuario"))
            ->add('email',TextType::class,array("label"=>"Correo electrónico"))
            ->add('fichero',FileType::class,array("label"=>"Fotografía"))
            ->add('ciclos',EntityType::class,array(
                "label"=>"Ciclos",
                "class"=>Ciclos::class,
                "choice_label"=>"codigo",
                "multiple"=>true,
            ))
            ->add('rol',ChoiceType::class,array(
                "label"=>"Rol",
                "placeholder"=>"Elija un rol",
                "choices" => array(
                "Profesor" => "profesor",
                "Director" => "director",
            )))
            ->add('Guardar',SubmitType::class,array("attr"=>array("class"=>"form-submit btn btn-success")));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Profesores'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_profesores';
    }


}
