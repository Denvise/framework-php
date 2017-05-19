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
        $routes->add('contact', new Route('/contact', array('_controller' => 'HomeController::contactAction')));
        $routes->add('about', new Route('/about', array('_controller' => 'HomeController::aboutAction')));
        $routes->add('login', new Route('/login', array('_controller' => 'HomeController::loginAction')));
        $routes->add('panel', new Route('/panel', array('_controller' => 'PanelController::PanelAction')));
        $routes->add('episode', new Route('/episode/{page}', array('_controller' => 'HomeController::showAction')));
        $routes->add('addEpisode', new Route('/panel/add', array('_controller' => 'PanelController::addAction')));
        $routes->add('addCommentaire', new Route('/panel/commentaires', array('_controller' => 'PanelController::ComAction')));
        $routes->add('deleteEpisode', new Route('/panel/delete/{page}', array('_controller' => 'PanelController::deleteAction')));
        $routes->add('editEpisode', new Route('/panel/edit/{page}', array('_controller' => 'PanelController::editPostAction')));
        $routes->add('deleteCom', new Route('/panel/deleteCom/{com}', array('_controller' => 'PanelController::deleteAction')));
        $routes->add('editCom', new Route('/panel/editCom/{com}', array('_controller' => 'PanelController::editAction')));
        return $routes;
    }
}
