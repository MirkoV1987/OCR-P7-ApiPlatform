<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProductController extends Controller
{
    /**
     * @Route("/products/{id}", name="app_product_show")
     */
    public function showAction()
    {
        $product = new Product();
        $product
            ->setName('Samsung Galaxy')
            ->setBrand('Samsung')
            ->setDesciption('Ceci est le nouveau modèle de Samsung Galaxy')
            ->setPrice(450)

        ;
        $data = $this->get('jms_serializer')->serialize($product, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
