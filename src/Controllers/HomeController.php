<?php

namespace Controllers;

use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Entities\Commentaire;
use Form\CommentType;
use Framework\Controller;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{
    public function homeAction($page = false)
    {

        $entityManager = $this->getDoctrine();
        $repository = $entityManager->getRepository("Entities\Article");

        $max_result = 10; // nombre d'articles par page

        // total d'article dans la bdd
        $total = $query = $repository->createQueryBuilder('articles')
            ->select('COUNT(articles)')
            ->getQuery()
            ->getSingleScalarResult();

        $nbPages = ceil($total/$max_result);
        if(isset($page) && $page > 0){
            $currentPage = intval($page);
        } else {
            $currentPage = 1;
        }



        $firstEnter = ($currentPage-1)*$max_result;
        $articles = $entityManager->getRepository("Entities\Article")->findBy(array(), array('id' => 'DESC'), $max_result, $firstEnter);
        $lastArticle = $entityManager->getRepository("Entities\Article")->findBy([], ['id' => 'DESC'], 1);
        $commentaire = $entityManager->getRepository("Entities\Commentaire")->findBy(['etat' => '1'], ['id' => 'DESC']);


        return $this->render('home.html.twig',[
            'moteur' => 'Twig',
            'articles' => $articles,
            'commentaire' => $commentaire,
            'lastArticle' => $lastArticle,
            'total' => $total,
            'nbPages' => $nbPages
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


        $commentaire = new Commentaire();
        $commentaire->setArticle($article);
        $commentaire->setEtat('0');
        $commentaire->getDateAjout('now');
        $form = $this->getFormFactory()->createBuilder(CommentType::class, $commentaire)->getForm();

        $form->handleRequest($this->getRequest());


        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($commentaire);
            $entityManager->flush();
            return $this->redirect("episode", ['page' => $page]);
        }

        // $commentaire = $entityManager->getRepository("Entities\Commentaire")->findByArticle($article);
        return $this->render('episode.html.twig',[
            'article' => $article,
            'lastArticle' => $lastArticle,
            'form'=>$form->createView()
            //  'commentaire' => $commentaire
        ]);
    }

    public function addCommentAction($page,$idParent = null)
    {
        $entityManager = $this->getDoctrine();
        $article = $entityManager->getRepository("Entities\Article")->find($page);
        $commentaire = new Commentaire();
        $commentaire->setArticle($article);
        $commentaire->setEtat('0');
        $commentaire->getDateAjout('now');
        if($idParent != null){
            $commentaire->setParent($entityManager->getRepository("Entities\Commentaire")->find($idParent));
        }
        $commentaire->setEtat(false);
        $commentaire->getDateAjout(new \DateTime());
        $form = $this->getFormFactory()->createBuilder(CommentType::class, $commentaire)->getForm();

        $form->handleRequest($this->getRequest());
        if ($form->isSubmitted() && $form->isValid()) {
             $entityManager->persist($commentaire);
             $entityManager->flush();
             return $this->redirect("episode", ['page' => $page]);
        }

    }
}
