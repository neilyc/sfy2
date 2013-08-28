<?php

namespace Test\HelloworldBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


class HelloworldController extends Controller
{
    public function indexAction(Request $request)
    {
    	if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $request->getSession()->get(SecurityContext::AUTHENTICATION_ERROR);
        }

		$context =  array(
            'last_username' => $request->getSession()->get(SecurityContext::LAST_USERNAME),
            'error'         => $error,
            'name'          => 'troger'
        );

        return $this->render('TestHelloworldBundle::index.html.twig', $context);
    }


    public function securityCheck() 
    {
    	// The security layer will intercept this request
    	echo "toto";
    }

    public function logoutAction()
    {
        // The security layer will intercept this request
    }
}
