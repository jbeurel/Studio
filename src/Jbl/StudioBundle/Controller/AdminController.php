<?php

namespace Jbl\StudioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;

class AdminController extends Controller
{
    public function indexAction()
    {
        return $this->render('JblStudioBundle:Admin:index.html.twig');
    }
    
    public function loginAction()
    {
    	// get the error if any
    	if ($this->get('request')->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
    		$error = $this->get('request')->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
    	} else {
    		$error = $this->get('request')->getSession()->get(SecurityContext::AUTHENTICATION_ERROR);
    	}
    
    	return $this->render('JblStudioBundle:Admin:login.html.twig', array(
	    	// last username entered by the user
		    'last_username' => $this->get('request')->getSession()->get(SecurityContext::LAST_USERNAME),
		    'error' => $error,
	    ));
    }
}
