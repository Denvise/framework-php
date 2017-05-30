<?php

namespace Framework;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing;
class App
{
    static public function run()
    {

        $router = self::getRouter();
        $_controller = $router['route']["_controller"];
        unset($router['route']["_controller"]);
        list($controllerClass, $actionMethod) = explode("::", $_controller);
        $controllerClass = "\Controllers\\" . $controllerClass;
        $routeName = $router["route"]["_route"];
        unset($router['route']["_route"]);
        $controller = new $controllerClass(Request::createFromGlobals(), $router['collection'], $routeName);
        $method = new \ReflectionMethod($controllerClass, $actionMethod);
        $args = [];
        foreach($method->getParameters() as $param) {
            $args[] = $router['route'][$param->getName()];
        }
        call_user_func_array(array($controller, $actionMethod), $args);

    }

    static private function getRouter(){

        $request = Request::createFromGlobals();
        $context = new Routing\RequestContext();
        $context->fromRequest($request);
        $locator = new FileLocator(array(__DIR__.'/Config'));

        $router = new Routing\Router(
            new Routing\Loader\PhpFileLoader($locator),
            'Routes.php',
            array(),
            $context
        );

        return array("route"=>$router->match($request->getPathInfo()), "collection" => $router->getRouteCollection());


    }


}





