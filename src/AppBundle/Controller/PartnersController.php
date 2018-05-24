<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Partner;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Partner controller.
 *
 * @Route("partners")
 */
class PartnersController extends Controller
{
    /**
     * Lists all partner entities.
     *
     * @Route("/", name="partners_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $partners = $em->getRepository('AppBundle:Partner')->findAll();
        $articles = $em->getRepository('AppBundle:Article')->findAll();

        return $this->render('partners/index.html.twig', array(
            'partners' => $partners,
            'articles' => $articles,
        ));
    }
}
