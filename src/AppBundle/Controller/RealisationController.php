<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class RealisationController extends controller {

    /**
     * @Route("/realisation"), name("app_realisation_index")
     */
    public function indexAction() {

        Return $this->render('realisation/realisations.html.twig');
    }
}