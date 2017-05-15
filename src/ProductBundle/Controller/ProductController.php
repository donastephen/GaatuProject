<?php

namespace ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use ProductBundle\Entity\Product;

class ProductController extends Controller
{
    public function indexAction()
    {
        return $this->render('ProductBundle:Product:index.html.twig');
    }
    
    public function addAction(Request $request)
    {
        $product = new Product(); 
        $form = $this->createFormBuilder($product)
            ->add('sku', NumberType::class)
            ->add('save', SubmitType::class, array('label' => 'ADD PRODUCT'))
            ->getForm();
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $product = $form->getData();
            $product->setCreatedAt(new \DateTime());
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();

            return $this->redirectToRoute('task_success');
        }

        return $this->render('ProductBundle:Product:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
