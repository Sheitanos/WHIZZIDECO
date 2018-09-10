<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Sketch;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Sketch controller.
 *
 * @Route("admin/sketch")
 */
class AdminSketchController extends Controller
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

        $deleteForms = [];

        foreach ($sketches as $sketch) {
            $deleteForm = $this->createDeleteForm($sketch)->createView();
            $deleteForms[$sketch->getId()] = $deleteForm;
        }

        return $this->render('admin/sketch/index.html.twig', array(
            'sketches' => $sketches,
            'delete_form' => $deleteForms,
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
            if (!$sketch->getImageFile()) {
                $this->addFlash('danger', 'No image');
            } else {
                $em = $this->getDoctrine()->getManager();
                $em->persist($sketch);
                $em->flush();
                $this->addFlash(
                    'notice',
                    'Votre partenaire a été crée avec succès'
                );

                return $this->redirectToRoute('admin');
            }
        }

        return $this->render('admin/sketch/new.html.twig', array(
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

        return $this->render('admin/sketch/show.html.twig', array(
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
            $this->addFlash(
                'notice',
                'Vos modifications ont été bien été prises en compte'
            );

            return $this->redirectToRoute('admin');
        }

        return $this->render('admin/sketch/edit.html.twig', array(
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

        return $this->redirectToRoute('admin');
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
