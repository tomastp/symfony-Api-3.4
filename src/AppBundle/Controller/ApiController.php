<?php

// src/AppBundle/Controller/ApiController.php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class ApiController extends FOSRestController
{
    /**
     * @Route("/api/v1/index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $data = array("hello" => "world");
        $view = $this->view($data);
        return $this->handleView($view);
    }

    /**
     * @Route("/api/v1/new")
     * @Method("POST")
     */
    public function newAction() {
        
        $user = $this->get('security.token_storage')->getToken()->getUser();

        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN') === TRUE) {
            throw new AccessDeniedException();
        }

        $data = array("user" => $user);
        $view = $this->view($data);
        return $this->handleView($view);
    }
}