<?php
/**
 * Created by PhpStorm.
 * User: gabriel
 * Date: 23/02/18
 * Time: 11:58
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Contact;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;



/**
 * Admincontact controller.
 *
 * @Route("admin/contact")
 */
class AdminContactController extends Controller
{
    /**
     * Displays a form to edit an existing contact entity.
     *
     * @Route("/{id}/edit", name="contact_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $contact = $em->getRepository('AppBundle:Contact')->findOneBy([]);
        if (!$contact) {
            $contact = new Contact();
        }
        $editForm = $this->createForm('AppBundle\Form\ContactType', $contact);
        $editForm->handleRequest($request);


        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em->persist($contact);
            $em->flush();
            $this->addFlash(
                'notice',
                'Vos modifications ont été bien été prises en compte'
            );

            return $this->redirectToRoute('admin');
        }

        return $this->render('admin/contact/edit.html.twig', array(
            'contact' => $contact,
            'edit_form' => $editForm->createView(),
        ));
    }
}