<?php
namespace Framework;

use Symfony\Component\Form\Extension\Csrf\CsrfExtension;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Form\Forms;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Translation\Loader\XliffFileLoader;



class Controller
{
    private $twig;
    private $doctrine;
    private $formFactory;

    public function __construct()
    {
        define('DEFAULT_FORM_THEME', 'form_div_layout.html.twig');

        define('VENDOR_DIR', realpath(__DIR__ . '/../vendor'));
        define('VENDOR_FORM_DIR', VENDOR_DIR . '/symfony/form');
        define('VENDOR_VALIDATOR_DIR', VENDOR_DIR . '/symfony/validator');
        define('VENDOR_TWIG_BRIDGE_DIR', VENDOR_DIR . '/symfony/twig-bridge');
        define('VIEWS_DIR', realpath(__DIR__ . '/../src/Views'));

        $loader = new \Twig_Loader_Filesystem(__DIR__.'/../src/Views/');
        $this->twig = new \Twig_Environment($loader, [
            'cache' => false
        ]);

        $isDevMode = true;

        $dbParams = array(
            'driver'   => 'pdo_mysql',
            'user'     => 'root',
            'password' => 'root',
            'dbname'   => 'blog',
        );

        $config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/../src/Entities"), $isDevMode);
        $this->doctrine = EntityManager::create($dbParams, $config);

        $validator = Validation::createValidator();
        $translator = new Translator('fr');
        $translator->addLoader('xlf', new XliffFileLoader());
        $translator->addResource('xlf', VENDOR_FORM_DIR . '/Resources/translatations/validators.fr.xlf', 'fr', 'validrators');
        $translator->addResource('xlf', VENDOR_VALIDATOR_DIR . '/Resources/translations/validators.fr.xlf', 'fr', 'validators');


        $formFactory = Forms::createFormFactoryBuilder()
            ->addExtension(new ValidatorExtension($validator))
            ->getFormFactory();

    }

    public function getFormFactory(){
        return $this->formFactory;
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
