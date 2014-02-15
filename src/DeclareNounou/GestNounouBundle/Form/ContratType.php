<?php

namespace DeclareNounou\GestNounouBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ContratType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateDebut', 'date', array('label'=>'Date de début'))
            ->add('dateFin', 'date', array('label'=>'Date de fin'))
            ->add('heuresMensuelles', 'text', array('label' => 'Heures mensuelles'))
            ->add('tarifHoraire','text', array('label'=>'Tarif horaire'))
            ->add('tarifRepas','text', array('label'=>'Tarif repas'))
            ->add('tarifIndemnite','text', array('label'=>'Tarif indemnités'))
            ->add('enfant', 'entity', array(
                'class' => 'DeclareNounouGestNounouBundle:Enfant',
                    'multiple' => false,
                    'expanded' => false,

                    ))
            ->add('nounou', 'entity', array(
                'class' => 'DeclareNounouGestNounouBundle:Nounou',
                    'multiple' => false,
                    'expanded' => false,
                    ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DeclareNounou\GestNounouBundle\Entity\Contrat'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'DeclareNounou_gestnounoubundle_contrat';
    }
}
