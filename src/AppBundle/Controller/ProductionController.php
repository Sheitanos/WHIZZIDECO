<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Production;
use AppBundle\Entity\ProductionPicture;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Production controller.
 *
 * @Route("production")
 */
class ProductionController extends Controller
{
    /**
     * Lists all production entities.
     *
     * @Route("/", name="production_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $productions = $em->getRepository('AppBundle:Production')->findAll();
        $productionPictures = $em->getRepository('AppBundle:ProductionPicture')->findAll();
        $tabLastTimeAfterProductionPictures = $this->getDoctrine()
                                                   ->getRepository(ProductionPicture::class)
                                                   ->findAfterPicturesWhithMaxUpdateAt();


        $newTabs = [];
        foreach ($tabLastTimeAfterProductionPictures as $tabLastTimeAfterProductionPicture){
            $lastUpdateAt = new \DateTime($tabLastTimeAfterProductionPicture[1]);
            $tabLastTimeAfterProductionPicture[1] = $lastUpdateAt;
            $newTabs[] = $tabLastTimeAfterProductionPicture;
        }
      $nbProductions = count($newTabs);

        return $this->render('production/index.html.twig', array(
            'productions' => $productions,
            'newTabs' => $newTabs,
            'productionPictures' => $productionPictures,
            'nbProductions' => $nbProductions,
        ));
    }

    /**
     * Finds and displays a production entity.
     *
     * @Route("/{id}", name="production_show")
     * @Method("GET")
     */
    public function showAction(Production $production)
    {
        $tabProductionBeforePicturesById = $this->getDoctrine()
                                                ->getRepository(ProductionPicture::class)
                                                ->findPicturesBeforeByProductionId($production->getId());
        $tabProductionAfterPicturesById = $this->getDoctrine()
                                                ->getRepository(ProductionPicture::class)
                                                ->findPicturesAfterByProductionId($production->getId());

        return $this->render('production/show.html.twig', array(
            'production' => $production,
            'tabProductionBeforePicturesById' => $tabProductionBeforePicturesById,
            'tabProductionAfterPicturesById' => $tabProductionAfterPicturesById,
        ));
    }
}
