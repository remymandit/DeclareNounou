<?php

namespace DeclareNounou\GestNounouBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use DeclareNounou\UserBundle\Entity\User;

class ContratType extends AbstractType
{
    private $user;

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
                'query_builder' => function (EntityRepository $repository) {
                    return $repository->createQueryBuilder('e')
                            ->where('e.user = :user')
                            ->setParameter('user',$this->getUser());
                },
                'multiple' => false,
                'expanded' => false,
                    ))
            ->add('nounou', 'entity', array(
                'class' => 'DeclareNounouGestNounouBundle:Nounou',
                'query_builder' => function (EntityRepository $repository) {
                    return $repository->createQueryBuilder('n')
                            ->where('n.user = :user')
                            ->setParameter('user',$this->getUser());
                },
                'multiple' => false,
                'expanded' => false,
                    ))
        ;
    }

    /**
     *
     * @return User \DeclareNounou\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     *
     * @param \DeclareNounou\UserBundle\Entity\User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     *
     * @param \DeclareNounou\UserBundle\Entity\User $currentuser
     */
    public function __construct(User $currentuser)
    {
        $this->setUser($currentuser);
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
