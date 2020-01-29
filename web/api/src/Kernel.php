<?php
/**
 * Ядро системы
 * PHP version 7.4.1.
 *
 * @category Application
 *
 * @author  sanerrus <username@example.com>
 * @license MIT http://www.example.com/License.tx
 *
 * @see http://www.example.com/Document.tx
 */
declare(strict_types=1);

namespace App;

use App\Configuration\AppConfiguration;
use App\Services\Middleware\CorsMiddleware;
use bitExpert\Disco\AnnotationBeanFactory;
use bitExpert\Disco\BeanFactoryRegistry;
use Laminas\Diactoros\ResponseFactory;
use League\Route\Router;
use League\Route\Strategy\JsonStrategy;
use Narrowspark\HttpEmitter\SapiEmitter;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Ядро приложения
 * Class Kernel.
 *
 * @category Application
 *
 * @author  sanerrus <username@example.com>
 * @license MIT http://www.example.com/License.tx
 *
 * @see http://www.example.com/Document.tx
 */
class Kernel
{
    private const CONFIG_FILE = 'config.yaml';

    /**
     * Контейнер приложения.
     *
     * @var ContainerInterface
     */
    private static ContainerInterface $container;

    /**
     * Экземпляр ядра.
     *
     * @var Kernel
     */
    private static Kernel $instance;

    public static function getInstance(): Kernel
    {
        if (isset(self::$instance) && self::$instance instanceof self) {
            return self::$instance;
        }

        self::$instance = new self();

        return self::$instance;
    }

    public function runHttp(ServerRequestInterface $request): void
    {
        $responseFactory = new ResponseFactory();
        $strategy = new JsonStrategy($responseFactory);
        $router = (new Router())->setStrategy($strategy);
        $router->middleware(new CorsMiddleware());

        // TODO: подумать как вынести роуты
        $router->map('GET', '/search-form', 'App\Controller\SearhFormController::getSearchForm');

        $response = $router->dispatch($request);

        $emitter = new SapiEmitter();
        $emitter->emit($response);
    }

    /**
     * Возвращает контейнер приложения.
     */
    public function getContainer(): ContainerInterface
    {
        if (isset(self::$container) && self::$container instanceof ContainerInterface) {
            return self::$container;
        }

        self::$container = new AnnotationBeanFactory(AppConfiguration::class);
        BeanFactoryRegistry::register(self::$container);

        return self::$container;
    }

    /**
     * Получаем конфигурационные параметры приложения.
     *
     * @return array <string|array> - многомерняй массив с параметрами указанных в config/config.yaml
     */
    public function getParameters(): array
    {
        return $this->getContainer()->get('appConfig');
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }
}
