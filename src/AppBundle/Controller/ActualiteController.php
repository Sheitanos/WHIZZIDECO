<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ActualiteController extends controller {

    /**
     * @Route("/actualite"), name("app_actualite_index")
     */
    public function indexAction() {

        Return $this->render('actualité/actualites.html.twig');
    }
}