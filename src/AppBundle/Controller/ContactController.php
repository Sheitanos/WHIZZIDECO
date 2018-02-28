<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ContactController extends controller {

    /**
     * @Route("/contact"), name("app_contact_index")
     */
    public function indexAction() {

        Return $this->render('contact/contact.html.twig');
    }
}