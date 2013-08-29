<?php

namespace Test\HelloworldBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;

class HelloworldController extends Controller
{
    public function indexAction(Request $request)
    {
        $context = array('name' => $this->getUser());
        return $this->render('TestHelloworldBundle::index.html.twig', $context);
    }

    public function helloAction(Request $request)
    {
        $context = array('name' => $this->getUser());
        return $this->render('TestHelloworldBundle::indexUser.html.twig', $context);
    }

    public function helloAdminAction(Request $request)
    {
        $context = array('name' => $this->getUser());
        return $this->render('TestHelloworldBundle::indexAdmin.html.twig', $context);
    }

    public function getUser(){
        $name = 'Anonymous';
        if($this->container->get('security.context')->getToken()->getUser() != 'anon.') {
            $name = $this->container->get('security.context')->getToken()->getUser()->getUsername();
        }
        return $name;
    }
}
