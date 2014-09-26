<?php

namespace DeclareNounou\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use DeclareNounou\UserBundle\Form\DataTransformer\InvitationToCodeTransformer;

class InvitationFormType extends AbstractType
{
    protected $invitationTransformer;

    public function __construct(InvitationToCodeTransformer $invitationTransformer)
    {
        $this->invitationTransformer = $invitationTransformer;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addViewTransformer($this->invitationTransformer, true);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'class'    => 'DeclareNounou\UserBundle\Entity\Invitation',
            'required' => true,
            'label'    => 'Code d\'invitation :'
        ));
    }

    public function getParent()
    {
        return 'text';
    }

    public function getName()
    {
        return 'declarenounou_invitation_type';
    }
}
