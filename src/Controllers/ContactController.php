<?php

namespace Controllers;

use Framework\Controller;

class ContactController extends Controller
{
    public function contactAction()
    {

        return $this->render('contact.html.twig',[]);
    }
}
