<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class PrestationController extends controller {

    /**
     * @Route("/prestation", name="app_prestation_index")
     */
    public function indexAction()
    {

        return $this->render('prestation/prestations.html.twig');
    }

}