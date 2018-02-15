<?php
/**
 * Created by PhpStorm.
 * User: fabien
 * Date: 08/02/18
 * Time: 22:02
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        // replace this example code with whatever you need
        return $this->render("home/index.html.twig");
    }

    /**
     * @Route("/prestations", name="index_prestations")
     */
    public function prestationsAction()
    {

        return $this->render('home/prestations.html.twig');
    }

    /**
     * @Route("/realisations", name="index_realisations")
     */
    public function realisationsAction()
    {

        return $this->render('home/prestations.html.twig');
    }

    /**
     * @Route("/ractualites", name="index_actualites")
     */
    public function actualitesAction()
    {

        return $this->render('home/actualites.html.twig');
    }

    /**
     * @Route("/contact", name="index_contact")
     */
    public function contactAction()
    {

        return $this->render('home/contact.html.twig');
    }



}