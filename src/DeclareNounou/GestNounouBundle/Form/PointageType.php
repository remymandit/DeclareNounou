<?php

namespace DeclareNounou\GestNounouBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PointageType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('datePointage','date',array('label'=>'Date du pointage'))
            ->add('heuresRealiseesPointage','text',array('label'=>'Heures réalisées'))
            ->add('heuresComplementaires','text',array('label'=>'Heures complémentaires'))
            ->add('heuresNormales','text',array('label'=>'Heures normales'))
            ->add('repas','checkbox',array(
                'required'=>false,
            ))
            ->add('periodes','collection',array(
                'type'=>new PeriodeType(),
                'allow_add'=>true,
                'allow_delete'=>true,
                'by_reference'=>false,
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DeclareNounou\GestNounouBundle\Entity\Pointage'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'declarenounou_gestnounoubundle_pointage';
    }
}
