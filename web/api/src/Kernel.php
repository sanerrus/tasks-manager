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
use App\Entity\TaskExtension;
use App\Entity\Users;
use bitExpert\Disco\AnnotationBeanFactory;
use bitExpert\Disco\BeanFactoryRegistry;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Psr\Container\ContainerInterface;

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
    private static ?ContainerInterface $container;

    /**
     * Менеджер сущностей БД.
     *
     * @var EntityManager
     */
    private static ?EntityManager $em;

    /**
     * Экземпляр ядра.
     *
     * @var Kernel|null
     */
    private static ?Kernel $instance = null;

    private function __construct()
    {
        self::$em = null;
        self::$container = null;
    }

    public static function getInstance(): Kernel
    {
        if (self::$instance instanceof Kernel) {
            return self::$instance;
        }
        self::$instance = new self();

        return self::$instance;
    }

    /**
     * Запускаем приложение, производим первоначальные настройки.
     */
    public function run(): void
    {
        /** Работа с БД */
//        $ent = $this->getEntityManager()->getRepository(Users::class)->findAll(); // test
//        $ent = $this->getEntityManager()->getRepository(Users::class)->getAllWithSpecifiedKey(); // test
//        var_dump($ent);
//        $this->getEntityManager()->getRepository(TaskExtension::class)->remove($ent);

        /** работа с сервисами */
        $userService = $this->getContainer()->get('usersService');
//        var_dump($userService);
        $users = $userService->findByName('user 1');
//        var_dump($users); // test
    }

    /**
     * Возвращает контейнер приложения.
     */
    public function getContainer(): ContainerInterface
    {
        if (self::$container instanceof EntityManager) {
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

    /**
     * Возвращаем иенеджер сущностей для работы с БД
     * (по логике здесь можно организовать пулл подключений).
     *
     * @throws \Doctrine\ORM\ORMException
     */
    public function getEntityManager(): EntityManager
    {
        if (self::$em instanceof EntityManager) {
            return self::$em;
        }

        $paramTasksdb = $this->getParameters()['databases']['tasksdb'];
        $paths = [__DIR__.DIRECTORY_SEPARATOR.'Entity'];
        $isDevMode = 'dev' === $this->getParameters()['environment'] ? true : false;

        $dbParams = [
            'driver' => 'pdo_mysql',
            'user' => $paramTasksdb['user'],
            'password' => $paramTasksdb['password'],
            'dbname' => $paramTasksdb['database'],
            'host' => $paramTasksdb['host'],
            'charset' => 'utf8',
        ];

        $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode, null, null, false);
        self::$em = EntityManager::create($dbParams, $config);

        return self::$em;
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }
}
