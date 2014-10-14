<?php

namespace Piotr\SliderBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Piotr\SliderBundle\Entity\Slider;

class SliderController extends Controller
{
	/**
	 * @Route("/", name="_slider_index_page")
	 * @Template()
	 */
	public function indexAction() {
		$sliderItems = $this->getDoctrine()->getRepository("PiotrSliderBundle:Slider")->findAll();
		return array('sliderItems'=>$sliderItems);
	} 
}
