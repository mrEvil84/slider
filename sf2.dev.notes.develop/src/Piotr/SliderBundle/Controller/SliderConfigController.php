<?php

namespace Piotr\SliderBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\Form;
use Piotr\SliderBundle\Entity\Slider;

class SliderConfigController extends Controller
{
	/**
	 * @Route("/add", name="_add_slider_item")
	 * @Template()
	 */
	public function addAction(Request $request) {
		
		$slider = new Slider();
		
		$form = $this->createFormBuilder($slider);
		$form->add('link','text');
		$form->add('description','textarea');
		$form->add('file','file');
		$form->add('save','submit',array('label'=>'Zapisz ...'));
		$form->getForm();	
		
		if ($form->getForm()->handleRequest($request)->isValid()) {
			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($slider);
			$entityManager->flush();
			$this->redirect($this->generateUrl('_maintain_slider_items'));
		}
		
		$formView = $form->getForm()->createView();
		
		return array('form'=>$formView);
	}
	
	/**
	 * @Route("/maintain", name="_maintain_slider_items")
	 * @Template()
	 */
	public function maintainAction(Request $request) {
  		
		$sliderItems = $this->getDoctrine()->getRepository("PiotrSliderBundle:Slider")->findAll();
		if(empty($sliderItems)) {
			//TODO: zaladowac zestaw 4 itemów domyœlny
			throw $this->itemsNotFoundException("Nie znaleziono elementow slidera");
		}
		return array('sliderItems'=>$sliderItems);
	}
	
	/**
	 * @Route("/update/{id}",requirements={"id"="\d+"}, defaults={"id"=0},name="_update_slider_item")
	 * @Template()
	 */
	public function updateAction(Request $request) {
		
		
		$id = $request->get('id');
		$entityManager = $this->getDoctrine()->getManager();
		$slider = $entityManager->getRepository("PiotrSliderBundle:Slider")->find($id);
		if(!$slider) {
			$this->createNotFoundException("Item not found: $id");
		}
		
		$form = $this->createFormBuilder($slider);
		$form->add('link','text');
		$form->add('description','textarea');
		$form->add('file','file',array('required'=>false));
		$form->add('save','submit',array('label'=>'Save'));
		$form->getForm();
		
		if ($form->getForm()->handleRequest($request)->isValid()) {

			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($slider);
			$entityManager->flush();
			return $this->redirect($this->generateUrl('_maintain_slider_items'));
		}
		
		$formView = $form->getForm()->createView();
		return array('form'=>$formView);
	}

	/**
	 *@Route("/delete/{id}",requirements={"id"="\d+"}, defaults={"id"=0},name="_delete_slider_item")
	 *@Template
	 */
	public function deleteAction(Request $request) {
		$id = $request->get('id');
		$entityManager = $this->getDoctrine()->getManager();
		$slider = $entityManager->getRepository("PiotrSliderBundle:Slider")->find($id);
		if(!$slider) {
			$this->createNotFoundException("Item not found: $id");
		} else {
			
			$entityManager->remove($slider);
			
			$entityManager->flush();	
			return $this->redirect($this->generateUrl('_maintain_slider_items')); 
		}
		return array();
	}

}
