<?php

namespace Controllers;

use Entities\Article;
use Framework\Controller;

class PostController extends Controller
{

    public function showAction($page = false)
    {
        $entityManager = $this->getDoctrine();
        $article = $entityManager->getRepository("Entities\Article")->find($page);

        // $commentaire = $entityManager->getRepository("Entities\Commentaire")->findByArticle($article);
        return $this->render('episode.html.twig',[
            'article' => $article,
          //  'commentaire' => $commentaire
        ]);
    }
}
