<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Sketch;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Sketch controller.
 *
 * @Route("sketch")
 */
class SketchController extends Controller
{
    /**
     * Lists all sketch entities.
     *
     * @Route("/", name="sketch_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sketches = $em->getRepository('AppBundle:Sketch')->findAll();

        return $this->render('sketch/index.html.twig', array(
            'sketches' => $sketches,
        ));
    }

    /**
     * Creates a new sketch entity.
     *
     * @Route("/new", name="sketch_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $sketch = new Sketch();
        $form = $this->createForm('AppBundle\Form\SketchType', $sketch);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sketch);
            $em->flush();

            return $this->redirectToRoute('sketch_show', array('id' => $sketch->getId()));
        }

        return $this->render('sketch/new.html.twig', array(
            'sketch' => $sketch,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a sketch entity.
     *
     * @Route("/{id}", name="sketch_show")
     * @Method("GET")
     */
    public function showAction(Sketch $sketch)
    {
        $deleteForm = $this->createDeleteForm($sketch);

        return $this->render('sketch/show.html.twig', array(
            'sketch' => $sketch,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing sketch entity.
     *
     * @Route("/{id}/edit", name="sketch_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Sketch $sketch)
    {
        $deleteForm = $this->createDeleteForm($sketch);
        $editForm = $this->createForm('AppBundle\Form\SketchType', $sketch);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sketch_edit', array('id' => $sketch->getId()));
        }

        return $this->render('sketch/edit.html.twig', array(
            'sketch' => $sketch,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a sketch entity.
     *
     * @Route("/{id}", name="sketch_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Sketch $sketch)
    {
        $form = $this->createDeleteForm($sketch);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($sketch);
            $em->flush();
        }

        return $this->redirectToRoute('sketch_index');
    }

    /**
     * Creates a form to delete a sketch entity.
     *
     * @param Sketch $sketch The sketch entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Sketch $sketch)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('sketch_delete', array('id' => $sketch->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
