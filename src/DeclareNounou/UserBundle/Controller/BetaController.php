<?php

namespace DeclareNounou\UserBundle\Controller;

use DeclareNounou\UserBundle\Entity\Invitation;
use DeclareNounou\UserBundle\Form\Type\NewInvitationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BetaController extends Controller
{
    public function newInvitationAction(Request $request)
    {
        $invitation = new Invitation();
        $form = $this->createForm(new NewInvitationFormType(), $invitation);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'success',
                'Votre demande de clé a bien été enregistrée, surveillez vos emails !'
            );

            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }

        return $this->render('DeclareNounouUserBundle:Beta:newInvitation.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}