<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class FctType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('anyo',NumberType::class,array("label"=>"Año"))
            ->add('periodo',ChoiceType::class,array(
                "label"=>"Periodo",
                "placeholder"=>"Seleccione un periodo",
                "choices" => array(
                    "Marzo-Junio" => "1",
                    "Septiembre-Diciembre" => "2",
                    "Enero-Marzo" => "3"
                )
            ))
            ->add('alumno',EntityType::class,array(
                'class' => 'AppBundle:Alumnos',
                'placeholder'=>"Elija un alumno",
            ))
            ->add('cod_ciclo',TextType::class,array("label"=>"Código ciclo"))
            ->add('empresas',EntityType::class,array(
                'class' => "AppBundle:Empresas",
                'placeholder' => "Elija una empresa",
                'choice_label' => 'nombre'
            ))
            ->add('profesor',EntityType::class,array(
                'class' => 'AppBundle:Profesores',
                'placeholder'=>"Elija un profesor",
            ))
            ->add('Guardar',SubmitType::class,array("attr"=>array(
                "class"=>"form-submit btn btn-success",)));


    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Fct'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_fct';
    }


}
