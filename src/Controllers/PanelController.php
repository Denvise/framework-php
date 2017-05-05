<?php

namespace Controllers;

use Entities\Article;
use Framework\Controller;

class PanelController extends Controller
{
    public function panelAction()
    {
        $entityManager = $this->getDoctrine();
        $articles = $entityManager->getRepository("Entities\Article")->findAll();
        $commentaire = $entityManager->getRepository("Entities\Commentaire")->findAll();
        return $this->render('adminPanel.html.twig',[
            'moteur' => 'Twig',
            'articles' => $articles,
            'commentaire' => $commentaire
        ]);
    }
}
