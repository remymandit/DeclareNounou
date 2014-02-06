<?php

namespace DeclareNounou\GestNounouBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
// pour sécuriser les actions à certains rôles
use JMS\SecurityExtraBundle\Annotation\Secure;

class GestNounouController extends Controller
{
    /**
     * Retourne la page d'accueil de l'appli nounou
     * ou affiche le formulaire login si l'utilisateur n'est pas logué
     * @return type
     * 
     */
    public function indexAction()
    {
        return $this->render('DeclareNounouGestNounouBundle:GestNounou:index.html.twig');
    }
}
?>
