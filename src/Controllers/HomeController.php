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
        $lastArticle = $entityManager->getRepository("Entities\Article")->findOneBy(array('titre' => 'purpose'));
        $commentaire = $entityManager->getRepository("Entities\Commentaire")->findAll();
        return $this->render('home.html.twig',[
            'moteur' => 'Twig',
            'articles' => $articles,
            'commentaire' => $commentaire,
            'lastArticle' => $lastArticle
        ]);
    }
}
