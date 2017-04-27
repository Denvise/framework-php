<?php
namespace Framework;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class Controller
{
    private $twig;

    public function __construct()
    {
        $loader = new \Twig_Loader_Filesystem(__DIR__.'/../src/Views/');
        $this->twig = new \Twig_Environment($loader, [
            'cache' => false
        ]);

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
