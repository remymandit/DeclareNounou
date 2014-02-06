<?php

namespace DeclareNounou\GestNounouBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EnfantType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom', 'text', array('label'=>'Prénom'))
            ->add('dateNaissance', 'date', array(
                //pour afficher les 15 années précédent l'année en cours
                'years' => range(date('Y')-15, date('Y')),
                'label'=>'Date de naissance',
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DeclareNounou\GestNounouBundle\Entity\Enfant'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'DeclareNounou_gestnounoubundle_enfant';
    }
}
