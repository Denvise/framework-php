<?php

namespace Controllers;

use Entities\Article;
use Framework\Controller;

class LoginController extends Controller
{

    public function loginAction()
    {
        $entityManager = $this->getDoctrine();
        $user = $entityManager->getRepository("Entities\User")->findAll();
        return $this->render('login.html.twig',[
            'user' => $user
        ]);
    }
}
