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

        return $this->render('prestation/prestations.html.twig'
        );
    }

    /**
     * @Route("/particulier", name="app_particulier_page")
     */
    public function particulierAction()
    {

        return $this->render('prestation/particulier.html.twig'
        );
    }

    /**
     * @Route("/professionel", name="app_professionel_page")
     */
    public function professionelAction()
    {

        return $this->render('prestation/professionel.html.twig'
        );
    }
}