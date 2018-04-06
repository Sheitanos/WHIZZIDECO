<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ProductionPicture;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Productionpicture controller.
 *
 * @Route("productionpicture")
 */
class ProductionPictureController extends Controller
{
    /**
     * Lists all productionPicture entities.
     *
     * @Route("/", name="productionpicture_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $productionPictures = $em->getRepository('AppBundle:ProductionPicture')->findAll();

        return $this->render('productionpicture/index.html.twig', array(
            'productionPictures' => $productionPictures,
        ));
    }

    /**
     * Creates a new productionPicture entity.
     *
     * @Route("/new", name="productionpicture_new")
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

            return $this->redirectToRoute('productionpicture_index');
        }

        return $this->render('productionpicture/new.html.twig', array(
            'productionPicture' => $productionPicture,
            'form' => $form->createView(),
        ));
    }


    /**
     * Displays a form to edit an existing productionPicture entity.
     *
     * @Route("/{id}/edit", name="productionpicture_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ProductionPicture $productionPicture)
    {
        $deleteForm = $this->createDeleteForm($productionPicture);
        $editForm = $this->createForm('AppBundle\Form\ProductionPictureType', $productionPicture);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('productionpicture_index');
        }

        return $this->render('productionpicture/edit.html.twig', array(
            'productionPicture' => $productionPicture,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a productionPicture entity.
     *
     * @Route("/{id}", name="productionpicture_delete")
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

        return $this->redirectToRoute('productionpicture_index');
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
            ->setAction($this->generateUrl('productionpicture_delete', array('id' => $productionPicture->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
