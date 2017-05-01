<?php

namespace Controllers;

use Framework\Controller;

class AboutController extends Controller
{
    public function AboutAction()
    {

        return $this->render('about.html.twig',[]);
    }
}
