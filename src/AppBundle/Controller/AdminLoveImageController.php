<?php

namespace AppBundle\Controller;

use AppBundle\Entity\LoveImage;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Sketch controller.
 *
 * @Route("admin/love-image")
 */
class AdminLoveImageController extends Controller
{
    /**
     * Lists all love images entities.
     *
     * @Route("/", name="love_image_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $loveImages = $em->getRepository('AppBundle:LoveImage')->findAll();

        $deleteForms = [];

        foreach ($loveImages as $loveImage) {
            $deleteForm = $this->createDeleteForm($loveImage)->createView();
            $deleteForms[$loveImage->getId()] = $deleteForm;
        }

        return $this->render('admin/loveImage/index.html.twig', array(
            'loveImages' => $loveImages,
            'delete_form' => $deleteForms,
        ));
    }

    /**
     * Creates a new loveImage entity.
     *
     * @Route("/new", name="love_image_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $loveImage = new LoveImage();
        $form = $this->createForm('AppBundle\Form\LoveImageType', $loveImage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (!$loveImage->getImageFile()) {
                $this->addFlash('danger', 'No image');
            } else {
                $em = $this->getDoctrine()->getManager();
                $em->persist($loveImage);
                $em->flush();
                $this->addFlash(
                    'notice',
                    'Votre image a été crée avec succès'
                );

                return $this->redirectToRoute('love_image_index');
            }
        }

        return $this->render('admin/loveImage/new.html.twig', array(
            'loveImage' => $loveImage,
            'form' => $form->createView(),
        ));
    }

//    /**
//     * Finds and displays a loveImage entity.
//     *
//     * @Route("/{id}", name="love_image_show")
//     * @Method("GET")
//     */
//    public function showAction(LoveImage $loveImage)
//    {
//        $deleteForm = $this->createDeleteForm($loveImage);
//
//        return $this->render('admin/loveImage/show.html.twig', array(
//            'loveImage' => $loveImage,
//            'delete_form' => $deleteForm->createView(),
//        ));
//    }

    /**
     * Displays a form to edit an existing loveImage entity.
     *
     * @Route("/{id}/edit", name="love_image_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, LoveImage $loveImage)
    {
        $deleteForm = $this->createDeleteForm($loveImage);
        $editForm = $this->createForm('AppBundle\Form\LoveImageType', $loveImage);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash(
                'notice',
                'Vos modifications ont été bien été prises en compte'
            );

            return $this->redirectToRoute('love_image_index');
        }

        return $this->render('admin/loveImage/edit.html.twig', array(
            'loveImage' => $loveImage,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a loveImage entity.
     *
     * @Route("/{id}", name="love_image_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, LoveImage $loveImage)
    {
        $form = $this->createDeleteForm($loveImage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($loveImage);
            $em->flush();
        }

        return $this->redirectToRoute('love_image_index');
    }

    /**
     * Creates a form to delete a sketch entity.
     *
     * @param LoveImage $loveImage The loveImage entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(LoveImage $loveImage)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('love_image_delete', array('id' => $loveImage->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
}
