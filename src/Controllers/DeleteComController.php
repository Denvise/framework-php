<?php

namespace Controllers;

use Doctrine\ORM\Mapping\Entity;
use Entities\Article;
use Entities\Commentaire;
use Form\CommentType;
use Framework\Controller;
use Symfony\Component\HttpFoundation\Session\Session;

class DeleteComController extends Controller
{

    public function deleteAction($com = false)
    {



        $entityManager = $this->getDoctrine();
        $commentaire = $entityManager->getRepository("Entities\Commentaire")->find($com);

        $entityManager->remove($commentaire);
        $entityManager->flush();


        return $this->render('comView.html.twig',[
            'article' => $commentaire,
        ]);
    }
}
