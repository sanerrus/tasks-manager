<?php
/**
 * Конфигурация контенера приложения
 * PHP version 7.4.1.
 *
 * @category Application
 *
 * @author  sanerrus <username@example.com>
 * @license MIT http://www.example.com/License.txt
 *
 * @see http://www.example.com/Document.txt
 */

namespace App\Configuration;

use App\Kernel;
use App\Services\Service;
use App\Services\ServiceInterface;
use App\Services\Tasks\TaskExtension\TaskExtension;
use App\Services\Tasks\TaskExtension\TaskExtensionInterface;
use App\Services\Tasks\Tasks;
use App\Services\Tasks\TasksInterface;
use App\Services\Tasks\TaskStatuses\TaskStatuses;
use App\Services\Tasks\TaskStatuses\TaskStatusesInterface;
use App\Services\Users\Users;
use App\Services\Users\UsersInterface;
use bitExpert\Disco\Annotations\Bean;
use bitExpert\Disco\Annotations\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

/**
 * Основной класс конфигурации.
 *
 * @category Application
 *
 * @author  sanerrus <username@example.com>
 * @license MIT http://www.example.com/License.tx
 *
 * @see http://www.example.com/Document.tx
 *
 * @Configuration
 */
class AppConfiguration
{
    /**
     * Бин конфигурационных данных.
     *
     * @return array <string|array> - многомерный массив с параметрами указанных в config/config.yaml
     *
     * @Bean
     */
    public function appConfig(): array
    {
        $config = \yaml_parse_file(
            __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.
            '..'.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.yaml'
        );

        return $config;
    }

    /**
     * Сервис работы с пользователями.
     *
     * @Bean
     */
    public function usersService(): UsersInterface
    {
        return new Users();
    }

    /**
     * Сервис работы с задачами.
     *
     * @Bean
     */
    public function tasks(): TasksInterface
    {
        return new Tasks();
    }

    /**
     * Сервис работы со статусами задачи.
     *
     * @Bean
     */
    public function taskStatuses(): TaskStatusesInterface
    {
        return new TaskStatuses();
    }

    /**
     * Сервис работы с комментариями к задаче.
     *
     * @Bean
     */
    public function taskExtension(): TaskExtensionInterface
    {
        return new TaskExtension();
    }

    /**
     * Log.
     *
     * @Bean
     */
    public function loger(): LoggerInterface
    {
        return new Logger('App');
    }

    /**
     * Менеджер управления сущностями БД.
     *
     * @Bean
     */
    public function entityManager(): EntityManager
    {
        $paramTasksdb = Kernel::getInstance()->getParameters()['databases']['tasksdb'];
        $paths = [__DIR__.DIRECTORY_SEPARATOR.'Entity'];
        $isDevMode = 'dev' === Kernel::getInstance()->getParameters()['environment'] ? true : false;

        $dbParams = [
            'driver' => 'pdo_mysql',
            'user' => $paramTasksdb['user'],
            'password' => $paramTasksdb['password'],
            'dbname' => $paramTasksdb['database'],
            'host' => $paramTasksdb['host'],
            'port' => $paramTasksdb['port'],
            'charset' => 'utf8',
        ];

        $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode, null, null, false);

        return EntityManager::create($dbParams, $config);
    }

    /**
     * Корневой сервис
     *
     * @Bean
     */
    public function service(): ServiceInterface
    {
        return new Service();
    }
}
