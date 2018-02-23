<?php
/**
 * Created by PhpStorm.
 * User: gabriel
 * Date: 23/02/18
 * Time: 11:58
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Home;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;



/**
 * Adminhome controller.
 *
 * @Route("admin/home")
 */
class AdminHomeController extends Controller
{
    /**
     * Displays a form to edit an existing home entity.
     *
     * @Route("/{id}/edit", name="home_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $home = $em->getRepository('AppBundle:Home')->findOneBy([]);
        if (!$home) {
            $home = new Home();
        }
        $editForm = $this->createForm('AppBundle\Form\HomeType', $home);
        $editForm->handleRequest($request);


        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em->persist($home);
            $em->flush();
            $this->addFlash(
                'notice',
                'Vos modifications ont été bien été prises en compte'
            );

            return $this->redirectToRoute('homepage');
        }

        return $this->render('admin/home/edit.html.twig', array(
            'home' => $home,
            'edit_form' => $editForm->createView(),
        ));
    }
}