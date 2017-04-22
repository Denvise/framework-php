<?php

namespace Framework\Config;

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

class Routes
{
    static public function getRoutes()
    {
        $routes = new RouteCollection();
        $routes->add('foo', new Route('/foo', array('_controller' => 'FooController::fooAction')));
        return $routes;
    }
}
