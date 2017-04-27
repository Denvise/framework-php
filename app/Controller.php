<?php
namespace Framework;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

class Controller
{
    private $twig;
    private $doctrine;

    public function __construct()
    {
        $loader = new \Twig_Loader_Filesystem(__DIR__.'/../src/Views/');
        $this->twig = new \Twig_Environment($loader, [
            'cache' => false
        ]);

        $dbParams = array(
            'driver'   => 'pdo_mysql',
            'user'     => 'root',
            'password' => 'root',
            'dbname'   => 'product',
        );

        $config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/../src/Entities"), false);
        $this->doctrine = EntityManager::create($dbParams, $config);

    }

    public function getDoctrine(){
        return $this->doctrine;
    }


    protected function render($filename,$data)
    {

        $response = new Response($this->twig->render($filename, $data));
        $response->send();
    }

    protected function json($data)
    {
        $response = new JsonResponse($data);
        $response->send();
    }
}
