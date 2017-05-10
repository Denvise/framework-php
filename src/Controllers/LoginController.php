<?php

namespace Controllers;

use Entities\Login;
use Framework\Controller;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class LoginController extends Controller
{

    public function loginAction()

    {

        $form = $this->createFormBuilder($login)
           ->add('username', TextType::class)
           ->add('password', PasswordType::class)
           ->add('Connexion', SubmitType::class)
           ->getForm();

        return $this->render('login.html.twig',array(
            'form' => $form->createView(),
                ));
    }
}
