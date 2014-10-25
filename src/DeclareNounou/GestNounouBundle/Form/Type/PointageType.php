<?php

namespace DeclareNounou\GestNounouBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use DeclareNounou\UserBundle\Entity\User;

class PointageType extends AbstractType
{
    private $user;

    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('contrat', 'entity', array(
                'class' => 'DeclareNounouGestNounouBundle:Contrat',
                'query_builder' => function (EntityRepository $repository) {
                    return $repository->createQueryBuilder('c')
                            ->leftJoin('c.nounou', 'n')
                            ->addSelect('n')
                            ->leftJoin('n.user', 'u')
                            ->addSelect('u')
                            ->where('u = :user')
                            ->setParameter('user',$this->getUser());
                },
                'multiple' => false,
                'expanded' => false,
                ))
            ->add('datePointage','date',array('label'=>'Date du pointage'))
            ->add('heureDebut', 'time',array('label'=>'Heure de début'))
            ->add('heureFin', 'time',array('label'=>'Heure de fin'))
            ->add('heuresRealiseesPointage','text',array(
                'label'=>'Heures réalisées'
                ))
            ->add('heuresComplementaires','text',array('label'=>'Heures complémentaires'))
            ->add('heuresNormales','text',array('label'=>'Heures normales'))
            ->add('repas','checkbox',array(
                'required'=>false,
                'value'=>1))
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
