<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class BoutiqueController extends controller {

    /**
     * @Route("/boutique"), name("app_boutique_index")
     */
    public function indexAction() {

        Return $this->render('boutique/boutique.html.twig');
    }
}