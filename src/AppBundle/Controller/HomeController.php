<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class HomeController extends Controller
{
    /**
     * Lists all home entities.
     *
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $homes = $em->getRepository('AppBundle:Home')->findOneBy([]);
        $sketchs = $em->getRepository('AppBundle:Sketch')->findAll();

        return $this->render('home/index.html.twig', array(
            'homes' => $homes,
            'sketchs' => $sketchs,
        ));
    }

}
