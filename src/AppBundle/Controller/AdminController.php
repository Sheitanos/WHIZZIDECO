<?php

namespace AppBundle\Controller;

use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class AdminController extends Controller
{
    /**
     * Lists all home entities.
     *
     * @Route("/admin", name="admin")
     */
    public function indexAction()
    {
        return $this->render('admin/admin.html.twig');

    }


    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function  testSuperAdmin()
    {
        $this->denyAccessUnlessGranted('ROLE_SUPER_ADMIN');
        return $this->render('FOSUserBundle/views/layout.html.twig');
    }

}
