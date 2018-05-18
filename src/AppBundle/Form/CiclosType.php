<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CiclosType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('codigo',TextType::class,array("label"=>"Código"))
            ->add('nombre',TextType::class,array("label"=>"Nombre"))
            ->add('grado',ChoiceType::class,array("label"=>"Grado","placeholder"=>"Elija un grado",
                "choices" => array(
        "Grado Superior" => "superior",
        "Grado Medio" => "medio",
    )))
            ->add('horasfct',TextType::class,array("label"=>"Horas FCT"))
            ->add('Guardar',SubmitType::class,array("attr"=>array(
                "class"=>"form-submit btn btn-success",)));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Ciclos'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_ciclos';
    }


}
