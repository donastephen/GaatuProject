<?php

namespace ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use ProductBundle\Entity\Product;
use ProductBundle\Entity\ProductList;
use ProductBundle\Form\Type\ProductListType;

class ProductListController extends Controller
{
    public function indexAction()
    {
        return $this->render('ProductBundle:Product:index.html.twig');
    }
    
    public function addAction(Request $request)
    {
        // create a task and give it some dummy data for this example
        $productList = new ProductList();

        
         $form = $this->createForm(ProductListType::class, $productList);

        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
        // $form->getData() holds the submitted values
        // but, the original `$task` variable has also been updated
        //$product = $form->getData();

        // ... perform some action, such as saving the task to the database
        // for example, if Task is a Doctrine entity, save it!
        // $em = $this->getDoctrine()->getManager();
        // $em->persist($task);
        // $em->flush();

        return $this->redirectToRoute('task_success');
    }

        
        
        return $this->render('ProductBundle:Product:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
