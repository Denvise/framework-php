<?php

namespace Controllers;

use Doctrine\ORM\Mapping\Entity;
use Entities\Article;
use Entities\Commentaire;
use Form\CommentType;
use Framework\Controller;

class PostController extends Controller
{

    public function showAction($page = false)
    {
        $entityManager = $this->getDoctrine();
        $article = $entityManager->getRepository("Entities\Article")->find($page);


        $commentaire = new Commentaire();
        $form = $this->getFormFactory()->createBuilder(CommentType::class, $commentaire)->getForm();
        $form->handleRequest($this->getRequest());

        if ($form->isSubmitted() && $form->isValid()){
            var_dump($commentaire);
            exit();
        }


        // $commentaire = $entityManager->getRepository("Entities\Commentaire")->findByArticle($article);
        return $this->render('episode.html.twig',[
            'article' => $article,
            'commentaire' => $commentaire,
            'form'=>$form->createView()
          //  'commentaire' => $commentaire
        ]);
    }
}
