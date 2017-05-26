<?php

namespace Framework;

use Knp\Bundle\PaginatorBundle\KnpPaginatorBundle;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing;
class App
{
    static public function run()
    {

        $KnpPaginator = new KnpPaginatorBundle();
        $router = self::getRouter();
        list($controllerClass, $actionMethod) = explode("::", array_shift($router['route']));
        $controllerClass = "\Controllers\\" . $controllerClass;
        $controller = new $controllerClass(Request::createFromGlobals(), $KnpPaginator, $router['collection'], array_pop($router['route']));
        call_user_func_array(array($controller, $actionMethod), $router['route']);



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





