<?php

namespace Controllers;

use Framework\Controller;


class FooController extends Controller
{
    public function fooAction()
    {
        return $this->render(__DIR__."/../Views/foo.php",[]);
    }
}
