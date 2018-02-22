<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Home;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


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

    /**
     * Creates a new home entity.
     *
     * @Route("/new", name="home_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $home = new Home();
        $form = $this->createForm('AppBundle\Form\HomeType', $home);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (!$home->getImageFile()) {
                $this->addFlash('danger', 'No image');
            } else {
                $em = $this->getDoctrine()->getManager();
                $em->persist($home);
                $em->flush();
                $this->addFlash(
                    'notice',
                    'Votre histoire a été crée avec succès'
                );

                return $this->redirectToRoute('homepage');
            }
        }

        return $this->render('home/new.html.twig', array(
            'home' => $home,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a home entity.
     *
     * @Route("/{id}", name="home_show")
     * @Method("GET")
     */
    public function showAction(Home $home)
    {
        $deleteForm = $this->createDeleteForm($home);

        return $this->render('home/show.html.twig', array(
            'home' => $home,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing home entity.
     *
     * @Route("/{id}/edit", name="home_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Home $home)
    {
        $deleteForm = $this->createDeleteForm($home);
        $editForm = $this->createForm('AppBundle\Form\HomeType', $home);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash(
                'notice',
                'Vos modifications ont été bien été prises en compte'
            );

            return $this->redirectToRoute('homepage');
        }

        return $this->render('home/edit.html.twig', array(
            'home' => $home,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a home entity.
     *
     * @Route("/{id}", name="home_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Home $home)
    {
        $form = $this->createDeleteForm($home);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($home);
            $em->flush();
        }

        return $this->redirectToRoute('homepage');
    }

    /**
     * Creates a form to delete a home entity.
     *
     * @param Home $home The home entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Home $home)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('home_delete', array('id' => $home->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
