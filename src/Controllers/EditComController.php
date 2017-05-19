<?php

namespace Controllers;

use Doctrine\ORM\Mapping\Entity;
use Entities\Commentaire;
use Framework\Controller;
use Symfony\Component\HttpFoundation\Session\Session;

class EditComController extends Controller
{

    public function editAction($com = false)
    {

        $entityManager = $this->getDoctrine();
        $com = $entityManager->getRepository("Entities\Commentaire")->find($com);

            $com = new Commentaire();
            $com->setEtat(true);
            $entityManager->flush();


        return $this->render('comView.html.twig',[
            'com' => $com,
        ]);
    }
}
