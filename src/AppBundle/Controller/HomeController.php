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
        $loveImages = $em->getRepository('AppBundle:LoveImage')->findAll();

        $numberOfSketches = count($sketchs);
        $numberOfLoveImages = count($loveImages);
//        die(dump($numberOfLoveImages));

//        return $this->render('home/index.html.twig', array(
//            'homes' => $homes,
//            'sketchs' => $sketchs,
//            'loveImages' => $loveImages,
//            'numberOfSketches' => $numberOfSketches,
//            'numberOfLoveImages' => $numberOfLoveImages,
//        ));
        return $this->render('home/construction.html.twig');
    }

}
