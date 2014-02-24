<?php

namespace DeclareNounou\GestNounouBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GestNounouController extends Controller
{
    /**
     * Retourne la page d'accueil de l'appli nounou
     * ou affiche le formulaire login si l'utilisateur n'est pas logué
     * @return \Symfony\Component\HttpFoundation\Response
     *
     */
    public function indexAction()
    {
        return $this->render('DeclareNounouGestNounouBundle:GestNounou:index.html.twig');
    }
}
