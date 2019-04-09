<?php
/**
 * Created by PhpStorm.
 * User: gabriel
 * Date: 23/02/18
 * Time: 11:58
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Prestation;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;



/**
 * AdminPrestation controller.
 *
 * @Route("admin/prestation")
 */
class AdminPrestationController extends Controller
{
    /**
     * Displays a form to edit an existing prestation entity.
     *
     * @Route("/{id}/edit", name="prestation_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $prestation = $em->getRepository('AppBundle:Prestation')->findOneBy([]);
        if (!$prestation) {
            $prestation = new Prestation();
        }
        $editForm = $this->createForm('AppBundle\Form\PrestationType', $prestation);
        $editForm->handleRequest($request);


        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em->persist($prestation);
            $em->flush();
            $this->addFlash(
                'notice',
                'Vos modifications ont été bien été prises en compte'
            );

            return $this->redirectToRoute('admin');
        }
        return $this->render('admin/prestation/edit.html.twig', array(
            'edit_form' => $editForm->createView(),
        ));
    }
}