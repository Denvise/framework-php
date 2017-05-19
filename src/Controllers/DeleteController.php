<?php

namespace Controllers;

use Doctrine\ORM\Mapping\Entity;
use Entities\Article;
use Entities\Commentaire;
use Form\CommentType;
use Framework\Controller;
use Symfony\Component\HttpFoundation\Session\Session;

class DeleteController extends Controller
{

    public function deleteAction($page = false)
    {



        $entityManager = $this->getDoctrine();
        $article = $entityManager->getRepository("Entities\Article")->find($page);

        $entityManager->remove($article);
        $entityManager->flush();


        return $this->render('adminPanel.html.twig',[
            'article' => $article,
        ]);
    }
}
