<?php

namespace Controllers;

use Entities\Article;
use Framework\Controller;

class HomeController extends Controller
{
    public function homeAction()
    {
        $entityManager = $this->getDoctrine();
        $articles = $entityManager->getRepository("Entities\Article")->findAll();
        $commentaire = $entityManager->getRepository("Entities\Commentaire")->findAll();
        return $this->render('home.html.twig',[
            'moteur' => 'Twig',
            'articles' => $articles,
            'commentaire' => $commentaire
        ]);
    }
}
