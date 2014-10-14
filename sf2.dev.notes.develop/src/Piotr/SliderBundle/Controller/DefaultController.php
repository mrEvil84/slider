<?php

namespace Piotr\SliderBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('PiotrSliderBundle:Default:index.html.twig', array('name' => $name));
    }
}
