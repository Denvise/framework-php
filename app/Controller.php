<?php
namespace Framework;

use Symfony\Bridge\Twig\Extension\FormExtension;
use Symfony\Bridge\Twig\Extension\TranslationExtension;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Form\Forms;
use Symfony\Bridge\Twig\Form\TwigRenderer;
use Symfony\Bridge\Twig\Form\TwigRendererEngine;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Form\Extension\Csrf\CsrfExtension;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Security\Csrf\TokenStorage\SessionTokenStorage;
use Symfony\Component\Security\Csrf\TokenGenerator\UriSafeTokenGenerator;
use Symfony\Component\Security\Csrf\CsrfTokenManager;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Translation\Loader\XliffFileLoader;
use Symfony\Component\Form\Extension\HttpFoundation\HttpFoundationExtension;
use Symfony\Component\Validator\Validation;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;


class Controller
{
    private $twig;
    private $doctrine = null;
    private $formFactory = null;
    private $request;
    private $config;
    private $routeCollection;

    public function __construct($request, $routeCollection)
    {

        $this->request = $request;
        $this->routeCollection = $routeCollection;

        $loader = new \Twig_Loader_Filesystem([__DIR__ . '/../src/Views/', __DIR__ . '/../vendor/symfony/twig-bridge/Resources/views/Form']);
        $this->twig = new \Twig_Environment($loader, [
            'cache' => false
        ]);
    }

    protected function getDoctrine(){
        if($this->doctrine === null) {
            $dbParams = array(
                'driver' => 'pdo_mysql',
                'user' => 'root',
                'password' => 'root',
                'dbname' => 'blog',
            );
            $isDevMode = true;
            $config = Setup::createAnnotationMetadataConfiguration(array(__DIR__ . "/../src/Entities"), $isDevMode);
            $this->doctrine = EntityManager::create($dbParams, $config);
        }
        return $this->doctrine;
    }



    protected function getFormFactory(){
        if($this->formFactory === null) {
            $session = new Session();
            $csrfStorage = new SessionTokenStorage($session);
            $csrfGenerator = new UriSafeTokenGenerator();
            $csrfManager = new CsrfTokenManager($csrfGenerator, $csrfStorage);

            $defaultFormTheme = isset($this->config["form"]["twig"]) ? $this->config["form"]["twig"] : 'bootstrap_3_layout.html.twig';

            $vendorDir = realpath(__DIR__ . '/../vendor');
            $vendorFormDir = $vendorDir . '/symfony/form';
            $vendorValidatorDir = $vendorDir . '/symfony/validator';

            $viewsDir = realpath(__DIR__ . '/../src/views');



            $formEngine = new TwigRendererEngine(array($defaultFormTheme), $this->twig);
            $this->twig->addExtension(new FormExtension());
            $this->twig->addRuntimeLoader(new \Twig_FactoryRuntimeLoader(array(
                TwigRenderer::class => function () use ($formEngine, $csrfManager) {
                    return new TwigRenderer($formEngine, $csrfManager);
                }
            )));

            $validator = Validation::createValidator();
            $translator = new Translator('fr');
            $translator->addLoader('xlf', new XliffFileLoader());
            $translator->addResource('xlf', $vendorFormDir . '/Resources/translations/validators.fr.xlf', 'fr', 'validators');

            $this->twig->addExtension(new TranslationExtension($translator));


            $this->formFactory = Forms::createFormFactoryBuilder()
                ->addExtension(new ValidatorExtension($validator))
                ->addExtension(new CsrfExtension($csrfManager))
                ->addExtension(new HttpFoundationExtension())
                ->getFormFactory();

        }
        return $this->formFactory;
    }

    protected function getRequest()
    {
        return $this->request;
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

    protected function redirect($route, $args = array()) {

        $context = new RequestContext();
        $generator = new UrlGenerator($this->routeCollection, $context);
        $response = new RedirectResponse($generator->generate($route, $args));
        $response->send();

    }


}
