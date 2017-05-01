<?php

namespace Framework\Config;

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

class Routes
{
    static public function getRoutes()
    {
        $routes = new RouteCollection();
        $routes->add('home', new Route('/', array('_controller' => 'HomeController::homeAction')));
        $routes->add('contact', new Route('/contact', array('_controller' => 'ContactController::contactAction')));
        $routes->add('about', new Route('/about', array('_controller' => 'AboutController::aboutAction')));
        $routes->add('episode', new Route('/episode/{page}', array('_controller' => 'PostController::showAction')));
        return $routes;
    }
}
