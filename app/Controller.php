<?php
namespace Framework;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class Controller
{
    protected function render($filename,$data)
    {
        ob_start();
        extract($data);
        include $filename;
        $content = ob_get_clean();

        $response = new Response($content);
        $response->send();
    }

    protected function json($data)
    {
        $response = new JsonResponse($data);
        $response->send();
    }
}
