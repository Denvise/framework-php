<?php

namespace Controllers;

use Entities\Article;
use Framework\Controller;

class PostController extends Controller
{

    public function showAction($page = null)
    {
        $entityManager = $this->getDoctrine();
        $articles = $entityManager->getRepository("Entities\Article")->findAll();
        $commentaire = $entityManager->getRepository("Entities\Commentaire")->findAll();
        return $this->render('episode.html.twig',[
            'page' => $page,
            'articles' => $articles,
            'commentaire' => $commentaire
        ]);
    }
}
