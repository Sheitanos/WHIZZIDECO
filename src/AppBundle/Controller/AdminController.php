<?php

namespace AppBundle\Controller;

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

}
