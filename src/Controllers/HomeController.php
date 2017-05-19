<?php

namespace Controllers;

use Entities\Article;
use Entities\Commentaire;
use Form\CommentType;
use Framework\Controller;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;

class HomeController extends Controller
{
    public function homeAction()
    {
        $entityManager = $this->getDoctrine();
        $articles = $entityManager->getRepository("Entities\Article")->findAll();
        $lastArticle = $entityManager->getRepository("Entities\Article")->findBy([], ['id' => 'DESC'], 1);
        $commentaire = $entityManager->getRepository("Entities\Commentaire")->findBy(['etat' => '1'], ['id' => 'DESC']);

        return $this->render('home.html.twig',[
            'moteur' => 'Twig',
            'articles' => $articles,
            'commentaire' => $commentaire,
            'lastArticle' => $lastArticle
        ]);
    }

    public function contactAction()
    {

        $entityManager = $this->getDoctrine();
        $lastArticle = $entityManager->getRepository("Entities\Article")->findBy([], ['id' => 'DESC'], 1);

        return $this->render('contact.html.twig',[
            'lastArticle' => $lastArticle
        ]);
    }

    public function AboutAction()
    {

        $em = $this->getDoctrine();
        $lastArticle = $em->getRepository("Entities\Article")->findBy([], ['id' => 'DESC'], 1);

        return $this->render('about.html.twig',[
            'lastArticle' => $lastArticle
        ]);
    }

    public function loginAction()

    {

        $entityManager = $this->getDoctrine();
        $lastArticle = $entityManager->getRepository("Entities\Article")->findBy([], ['id' => 'DESC'], 1);


        $form = $this->getFormFactory()->createBuilder()
            ->add('username', TextType::class)
            ->add('password', PasswordType::class)
            ->add('Connexion', SubmitType::class)
            ->getForm();

        return $this->render('login.html.twig',array(
            'lastArticle' => $lastArticle,
            'form' => $form->createView(),
        ));
    }

    /**
     * @param bool $page
     */
    public function showAction($page = false)
    {



        $entityManager = $this->getDoctrine();
        $lastArticle = $entityManager->getRepository("Entities\Article")->findBy([], ['id' => 'DESC'], 1);
        $article = $entityManager->getRepository("Entities\Article")->find($page);
        $commentaires = $entityManager->getRepository("Entities\Commentaire")->findBy(['id_article' => $page, 'etat' => '1']);


        $commentaire = new Commentaire();
        $commentaire->setIdArticle($page);
        $commentaire->setEtat('0');
        $commentaire->getDateAjout('now');
        $form = $this->getFormFactory()->createBuilder(CommentType::class, $commentaire)->getForm();

        $form->handleRequest($this->getRequest());


        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($commentaire);
            $entityManager->flush();

        }



        // $commentaire = $entityManager->getRepository("Entities\Commentaire")->findByArticle($article);
        return $this->render('episode.html.twig',[
            'article' => $article,
            'lastArticle' => $lastArticle,
            'commentaires' => $commentaires,
            'form'=>$form->createView()
            //  'commentaire' => $commentaire
        ]);
    }
}
