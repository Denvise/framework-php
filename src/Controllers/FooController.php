<?php

namespace Controllers;

use Framework\Controller;

class FooController extends Controller
{
    public function fooAction()
    {
        $entityManager = $this->getDoctrine();
        $products = $entityManager->getRepository("Entities\Product")->findAll();
        return $this->render('foo.html.twig',['moteur' => 'Twig', 'products' => $products ]);
    }
}
