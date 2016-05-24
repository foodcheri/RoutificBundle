<?php

namespace Foodcheri\SDKRoutificBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('FoodcheriSDKRoutificBundle:Default:index.html.twig', array('name' => $name));
    }
}
