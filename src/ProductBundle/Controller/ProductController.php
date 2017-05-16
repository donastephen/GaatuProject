<?php

namespace ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ProductBundle\Entity\Product;
use Symfony\Component\Form\FormError;

class ProductController extends Controller
{
    public function indexAction()
    {
        return $this->render('ProductBundle:Product:index.html.twig');
    }
    
    /**
     * Controller Action to add new Product
     * @param Request $request
     * @return Response
     */
    public function addAction(Request $request)
    {
        $product = new Product(); 
        $form = $this->createFormBuilder($product)
            ->add('name', TextType::class)
            ->add('sku', NumberType::class)
            ->add('save', SubmitType::class, array('label' => 'SAVE'))
            ->getForm();
        $form->handleRequest($request);
        
        if ($form->isSubmitted()) {
            if($form->isValid()){
                $product = $form->getData();
                $product->setCreatedAt(new \DateTime());
                $em = $this->getDoctrine()->getManager();
                $em->persist($product);
                $em->flush();
                return new Response('Successfully saved new product.' );
            } else {
                $form->addError(new FormError('Invalid data. Please enter again.'));
            }
            
        }

        return $this->render('ProductBundle:Product:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
