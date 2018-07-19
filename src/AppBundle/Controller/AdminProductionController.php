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
 * @Route("admin/production")
 */
class AdminProductionController extends Controller
{
    /**
     * Lists all production entities.
     *
     * @Route("/", name="adminProduction_index")
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

        $deleteForms = [];

        foreach ($productions as $production) {
            $deleteForm = $this->createDeleteForm($production)->createView();
            $deleteForms[$production->getId()] = $deleteForm;
        }

        return $this->render('admin/production/index.html.twig', array(
            'productions' => $productions,
            'newTabs' => $newTabs,
            'productionPictures' => $productionPictures,
            'delete_form' => $deleteForms,
        ));
    }
    /**
     * Creates a new production entity.
     *
     * @Route("/new", name="production_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $production = new Production();
        $form = $this->createForm('AppBundle\Form\ProductionType', $production);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($production);
            $em->flush();

            return $this->redirectToRoute('production_show', array('id' => $production->getId()));
        }

        return $this->render('admin/production/new.html.twig', array(
            'production' => $production,
            'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing production entity.
     *
     * @Route("/{id}/edit", name="production_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Production $production)
    {
        $deleteForm = $this->createDeleteForm($production);
        $editForm = $this->createForm('AppBundle\Form\ProductionType', $production);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('production_edit', array('id' => $production->getId()));
        }

        return $this->render('admin/production/edit.html.twig', array(
            'production' => $production,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a production entity.
     *
     * @Route("/{id}", name="production_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Production $production)
    {
        $form = $this->createDeleteForm($production);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($production);
            $em->flush();
        }

        return $this->redirectToRoute('production_index');
    }

    /**
     * Creates a form to delete a production entity.
     *
     * @param Production $production The production entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Production $production)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('production_delete', array('id' => $production->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
}
