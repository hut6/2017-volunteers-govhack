<?php

namespace AppBundle\Form;

use Oh\GoogleMapFormTypeBundle\Form\Type\GoogleMapType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmergencyType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description')
            ->add('emergencyType')
            ->add('lat')
            ->add('lon')
            ->add('skills', EntityType::class, array(
                'class' => 'AppBundle\Entity\Skill',
                'multiple'     => true,
                'expanded' => true,
                'label' => "Skills required"
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Emergency'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_emergency';
    }


}
