<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends controller
{

    /**
     * @Route("/contact"), name("app_contact_index")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request, \Swift_Mailer $mailer)
    {
        $form = $this->createForm('AppBundle\Form\SendMailType');
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();

            $from = $this->getParameter('mailer_user');
            $to = $this->getParameter('mailer_to');

            $message = (new \Swift_Message())
                ->setFrom($from)
                ->setTo($to)
                ->setBody(
                    $this->renderView(
                        'contact/message.html.twig',
                        array(
                            'lastname' => $data['lastname'],
                            'firstname' => $data['firstname'],
                            'email' => $data['email'],
                            'phoneNumber' => $data['phoneNumber'],
                            'message' => $data['message'],
                        )),
                    'text/html'
                );

            $mailer->send($message);

            $this->addFlash(
                'notice',
                'Votre mail a bien été envoyé'
            );
            return $this->redirectToRoute('homepage');
        }

        return $this->render('contact/contact.html.twig',
            [
                'form' => $form->createView()
            ]);
    }
}