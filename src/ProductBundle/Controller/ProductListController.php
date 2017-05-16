<?php

namespace ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ProductBundle\Entity\Product;
use ProductBundle\Entity\ProductList;
use ProductBundle\Form\Type\ProductListType;
use Symfony\Component\Form\FormError;

class ProductListController extends Controller
{
    public function indexAction()
    {
        return $this->render('ProductBundle:Product:index.html.twig');
    }
    
    public function newAction(Request $request)
    {
        //dummy product object for the form
        $productList = new ProductList();     
        $product1 = new Product();
        $productList->getProducts()->add($product1);      
        $form = $this->createForm(ProductListType::class, $productList);
        $form->handleRequest($request);      
        //Code when the form gets submitted
        if ($form->isSubmitted()) {
            $data = $request->request->all();
            $productList = new ProductList();
            $productList->setName($data['product_list']['name']);
            $productList->setDescription($data['product_list']['description']);
            $productList->setCreatedAt(new \DateTime());            
            $products = $data['product_list']['products'];
            $result = $this->addProducts($products, $productList); 
            if ($result) {
                // Validate the productList Object
                $validator = $this->get('validator');
                $errors = $validator->validate($productList);
                if (!empty($errors)) {
                    $em = $this->getDoctrine()->getEntityManager();
                    $em->persist($productList); 
                    $em->flush();
                    return new Response('Successfully added new product list.' );
                } else {
                    $form->addError(new FormError('Invalid Data.Please make sure you are entering valid product SKU. Try again.'));
                }

            } else {
                // if error show error in form
                $form->addError(new FormError('Invalid Data. Please make sure you are entering valid product SKU. Try again.'));
            }                      
        }
         return $this->render('ProductBundle:ProductList:new.html.twig', array(
            'form' => $form->createView(),
        ));
        
    }
   
    /**
     * Method to add products to the Product List if it is valid and if same product doesn't exist.
     * @param array $products
     * @param ProductList $productList
     * @return boolean
     */
    private function addProducts($products, &$productList)
    {
        if (empty($products)){
            return false;
        }
        foreach ($products as $product) {
            $sku = (strlen($product['sku']) > 6)? substr($product['sku'],0, 6) : $product['sku'];

            // Checking whether product exists in Product table
            $product = $this->getDoctrine()
                        ->getRepository('ProductBundle:Product')
                        ->findOneBySku($sku);

            // Checking whether this product has been already added to current Product List
            if ($product && !$productList->hasProduct($product)){
                $productList->getProducts()->add($product);
            }
            else {
                // breaking from the loop if we have got any bad sku
                return false;
            }              
        }
        return true;
        
    }
}
