<?php

namespace AppBundle\Form;

use AppBundle\Entity\Skill;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
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
            ->add('emergencyType', null, ['label' => "Incident type"])
            ->add('description', null, ['label' => "Incident description"])
            ->add('lat')
            ->add('lon')
            ->add('skills', EntityType::class, array(
                'class' => 'AppBundle\Entity\Skill',
                'multiple'     => true,
                'expanded' => true,
                'label' => "People to notify / call in for this incident",
                'group_by' => "type",
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.type', 'ASC');
                },
                'choice_label' => function (Skill $element) {
                    return $element->getType() . " - " . $element->getName();
                }
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
