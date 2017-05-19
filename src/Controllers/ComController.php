<?php

namespace Controllers;

use Entities\Article;
use Framework\Controller;

class ComController extends Controller
{
    public function ComAction()
    {
        $entityManager = $this->getDoctrine();
        $commentaire = $entityManager->getRepository("Entities\Commentaire")->findBy(['etat' => 0], ['etat' => 'DESC']);

        return $this->render('comView.html.twig',[
            'commentaire' => $commentaire,
        ]);
    }
}
