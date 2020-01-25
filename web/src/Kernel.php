<?php

declare(strict_types=1);
/**
 * Ядро системы
 * PHP version 7.4.1.
 *
 * @category Application
 *
 * @author   sanerrus <username@example.com>
 * @license  MIT http://www.example.com/License.tx
 *
 * @see     http://www.example.com/Document.tx
 */

namespace App;

use App\Configuration\AppConfiguration;
use App\Entity\TaskExtension;
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
 * @author   sanerrus <username@example.com>
 * @license  MIT http://www.example.com/License.tx
 *
 * @see     http://www.example.com/Document.tx
 */
class Kernel
{
    private const CONFIG_FILE = 'config.yaml';

    /**
     * Контейнер приложения.
     *
     * @var ContainerInterface
     */
    private ContainerInterface $container;

    private EntityManager $em;

    /**
     * Запускаем приложение, производим первоначальные настройки.
     */
    public function run(): void
    {
        $this->container = new AnnotationBeanFactory(AppConfiguration::class);
        BeanFactoryRegistry::register($this->container);

        $paramTasksdb = $this->getParameters()['databases']['tasksdb'];
        $paths = [__DIR__.DIRECTORY_SEPARATOR.'Entity'];
        $isDevMode = true;

        // the connection configuration
        $dbParams = [
            'driver' => 'pdo_mysql',
            'user' => $paramTasksdb['user'],
            'password' => $paramTasksdb['password'],
            'dbname' => $paramTasksdb['database'],
            'host' => $paramTasksdb['host'],
            'charset' => 'utf8',
        ];

        $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode, null, null, false);
        $this->em = EntityManager::create($dbParams, $config);
        var_dump($this->em->getRepository(TaskExtension::class)->find(1));
    }

    /**
     * Возвращает контейнер приложения.
     */
    public function getContainer(): ContainerInterface
    {
        return $this->container;
    }

    public function getParameters(): array
    {
        return $this->getContainer()->get('appConfig');
    }

    public function getEntityManager(): EntityManager
    {
        return $this->em;
    }
}
