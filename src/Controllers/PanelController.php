<?php

namespace Controllers;

use Entities\Article;
use Entities\Commentaire;
use Form\EditType;
use Form\PostType;
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

    public function addAction()

    {


        $entityManager = $this->getDoctrine();

        $article = new Article();
        $article->getDateAjout('now');
        $form = $this->getFormFactory()->createBuilder(PostType::class, $article)->getForm();

        $form->handleRequest($this->getRequest());

        if($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($article);
            $entityManager->flush();
        }


        return $this->render('addPost.html.twig',[
            'form'=>$form->createView()
        ]);
    }

    public function ComAction()
    {
        $entityManager = $this->getDoctrine();
        $commentaires = $entityManager->getRepository("Entities\Commentaire")->findBy(['etat' => 0], ['etat' => 'DESC']);

        return $this->render('comView.html.twig',[
            'commentaires' => $commentaires,
        ]);
    }

    public function deleteAction($com = false)
    {



        $entityManager = $this->getDoctrine();
        $commentaire = $entityManager->getRepository("Entities\Commentaire")->find($com);

        $entityManager->remove($commentaire);
        $entityManager->flush();return $this->redirect("addCommentaire");


        return $this->render('comView.html.twig',[
            'commentaire' => $commentaire,
        ]);
    }

    public function editAction($com = false)
    {

        $entityManager = $this->getDoctrine();
        $com = $entityManager->getRepository("Entities\Commentaire")->find($com);
        $com->setEtat(true);
        $entityManager->flush();
        return $this->redirect("addCommentaire");


        return $this->render('comView.html.twig',[
            'com' => $com,
        ]);
    }

    public function editPostAction($page = false)
    {

        $entityManager = $this->getDoctrine();
        $article = $entityManager->getRepository("Entities\Article")->find($page);
        $form = $this->getFormFactory()->createBuilder(EditType::class, $article)->getForm();

        $form->handleRequest($this->getRequest());

        if($form->isSubmitted() && $form->isValid()) {


            $entityManager->flush();
        }


        return $this->render('edit.html.twig',[
            'article' => $article,
            'form'=>$form->createView()
        ]);
    }
}
