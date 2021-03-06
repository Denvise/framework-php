<?php

namespace Framework\Config;

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;


        $routes = new RouteCollection();
        $routes->add('home', new Route('/page/{page}', array('_controller' => 'HomeController::homeAction', "page" => 1)));
        $routes->add('contact', new Route('/contact', array('_controller' => 'HomeController::contactAction')));
        $routes->add('about', new Route('/about', array('_controller' => 'HomeController::aboutAction')));
        $routes->add('login', new Route('/login', array('_controller' => 'HomeController::loginAction')));
        $routes->add('panel', new Route('/panel', array('_controller' => 'PanelController::PanelAction')));
        $routes->add('episode', new Route('/episode/{page}', array('_controller' => 'HomeController::showAction')));
        $routes->add('addEpisode', new Route('/panel/add', array('_controller' => 'PanelController::addPostAction')));
        $routes->add('commentaireView', new Route('/panel/commentaires', array('_controller' => 'PanelController::ComAction')));
        $routes->add('addComment', new Route('/episode/add-com/{page}/{idParent}', array('_controller' => 'HomeController::addCommentAction','idParent'=>null)));
        $routes->add('deleteEpisode', new Route('/panel/delete/{page}', array('_controller' => 'PanelController::deletePostAction')));
        $routes->add('editEpisode', new Route('/panel/edit/{page}', array('_controller' => 'PanelController::editPostAction')));
        $routes->add('deleteCom', new Route('/panel/deleteCom/{com}', array('_controller' => 'PanelController::deleteAction')));
        $routes->add('editCom', new Route('/panel/editCom/{com}', array('_controller' => 'PanelController::editAction')));
        $routes->add('accueil', new Route('/{page}', array('_controller' => 'HomeController::homeAction', "page" => 1)));
        return $routes;
