<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ProductionPicture;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * ProductionPicture controller.
 *
 * @Route("admin/productionPicture")
 */
class AdminProductionPictureController extends Controller
{
    /**
     * Lists all productionPicture entities.
     *
     * @Route("/", name="productionPicture_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $productionPictures = $em->getRepository('AppBundle:ProductionPicture')->findAll();

        $productions  =[];

        foreach ($productionPictures as $productionPicture) {

            if($productionPicture->getBeforeProduction() != null){
                $productions[$productionPicture->getBeforeProduction()->getId()] = $productionPicture->getBeforeProduction()->getTitle();
            }
            if ($productionPicture->getAfterProduction() != null){
                $productions[$productionPicture->getAfterProduction()->getId()] = $productionPicture->getAfterProduction()->getTitle();
            }
        }

        return $this->render('admin/productionPicture/chooseProd.html.twig', array(
            'productions' => $productions,
        ));
    }

    /**
     * productionPictures folders choices.
     *
     * @Route("/{productionId}/productionPicturesFoldersChoices", name="productionPictures_folders_choices")
     * @Method("GET")
     */
    public function productionPicturesFoldersChoices($productionId)
    {
        return $this->render('admin/productionPicture/choices.html.twig', array(
            'productionId' => $productionId,
        ));
    }

    /**
     * productionPictures choosen folder before.
     *
     * @Route("/{productionId}/productionPicturesChoosenFolderBefore", name="productionPictures_choosen_folder_before")
     * @Method("GET")
     */
    public function productionPicturesChoosenFolderBefore($productionId)
    {
        $em = $this->getDoctrine()->getManager();

        $productionPictures = $em->getRepository('AppBundle:ProductionPicture')->findAll();

        $deleteForms = [];
        $productionsPicturesBefore = [];

        foreach ($productionPictures as $productionPicture) {
            $deleteForm = $this->createDeleteForm($productionPicture)->createView();
            $deleteForms[$productionPicture->getId()] = $deleteForm;

            if($productionPicture->getBeforeProduction() != null && $productionPicture->getBeforeProduction()->getId() == $productionId){
                $productionsPicturesBefore[] = $productionPicture;
            }
        }

        return $this->render('admin/productionPicture/indexBefore.html.twig', array(
            'productionsPicturesBefore' => $productionsPicturesBefore,
            'delete_form' => $deleteForms,
        ));
    }

    /**
     * productionPictures choosen folder after.
     *
     * @Route("/{productionId}/productionPicturesChoosenFolderAfter", name="productionPictures_choosen_folder_after")
     * @Method("GET")
     */
    public function productionPicturesChoosenFolderAfter($productionId)
    {
        $em = $this->getDoctrine()->getManager();

        $productionPictures = $em->getRepository('AppBundle:ProductionPicture')->findAll();

        $deleteForms = [];
        $productionsPicturesAfter = [];

        foreach ($productionPictures as $productionPicture) {
            $deleteForm = $this->createDeleteForm($productionPicture)->createView();
            $deleteForms[$productionPicture->getId()] = $deleteForm;

            if ($productionPicture->getAfterProduction() != null && $productionPicture->getAfterProduction()->getId() == $productionId){
                $productionsPicturesAfter[] = $productionPicture;
            }
        }

        return $this->render('admin/productionPicture/indexAfter.html.twig', array(
            'productionsPicturesAfter' => $productionsPicturesAfter,
            'delete_form' => $deleteForms,
        ));
    }

    /**
     * Creates a new productionPicture entity.
     *
     * @Route("/new", name="productionPicture_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $productionPicture = new ProductionPicture();
        $form = $this->createForm('AppBundle\Form\ProductionPictureType', $productionPicture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($productionPicture);
            $em->flush();

            return $this->redirectToRoute('productionPicture_index');
        }

        return $this->render('admin/productionPicture/new.html.twig', array(
            'productionPicture' => $productionPicture,
            'form' => $form->createView(),
        ));
    }


    /**
     * Displays a form to edit an existing productionPicture entity.
     *
     * @Route("/{id}/edit", name="productionPicture_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ProductionPicture $productionPicture)
    {
        $deleteForm = $this->createDeleteForm($productionPicture);
        $editForm = $this->createForm('AppBundle\Form\ProductionPictureType', $productionPicture);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('productionPicture_index');
        }

        return $this->render('admin/productionPicture/edit.html.twig', array(
            'productionPicture' => $productionPicture,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a productionPicture entity.
     *
     * @Route("/{id}", name="productionPicture_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ProductionPicture $productionPicture)
    {
        $form = $this->createDeleteForm($productionPicture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($productionPicture);
            $em->flush();
        }

        return $this->redirectToRoute('productionPicture_index');
    }

    /**
     * Creates a form to delete a productionPicture entity.
     *
     * @param ProductionPicture $productionPicture The productionPicture entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ProductionPicture $productionPicture)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('productionPicture_delete', array('id' => $productionPicture->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
