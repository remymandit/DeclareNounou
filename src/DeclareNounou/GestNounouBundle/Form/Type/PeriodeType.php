<?php

namespace DeclareNounou\GestNounouBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PeriodeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('heureDebut', 'time',array(
                'label'=>'Heure de début',
                //'input'=>'datetime',
                //'widget'=>'choice',
            ))
            ->add('heureFin', 'time',array(
                'label'=>'Heure de fin',
                //'input'=>'datetime',
                //'widget'=>'choice',
            ))
            ->add('heuresRealiseesPeriode','text',array(
                'label'=>'Heures réalisées',
                'disabled'=>'true',
            ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DeclareNounou\GestNounouBundle\Entity\Periode'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'declarenounou_gestnounoubundle_periode';
    }
}
