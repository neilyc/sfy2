<?php

namespace Test\HelloworldBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HelloworldController extends Controller
{
    public function indexAction()
    {
        $context['name'] = 'troger';

        return $this->render('TestHelloworldBundle::index.html.twig', $context);
    }
}
