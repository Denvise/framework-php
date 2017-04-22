<?php

namespace Controllers;

use Framework\Controller;

class FooController extends Controller
{
    public function fooAction()
    {
        return $this->json(["bar"=>"salut les loulous"]);
        // return $this->render(__DIR__."/../Views/foo.php",["bar"=>"salut les loulous"]);
    }
}
