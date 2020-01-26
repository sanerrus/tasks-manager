<?php
/**
 * Конфигурация контенера приложения
 * PHP version 7.4.1.
 *
 * @category Application
 *
 * @author  sanerrus <username@example.com>
 * @license MIT http://www.example.com/License.tx
 *
 * @see http://www.example.com/Document.tx
 */

namespace App\Configuration;

use App\Kernel;
use App\Services\Users\Users;
use App\Services\Users\UsersInterface;
use bitExpert\Disco\Annotations\Bean;
use bitExpert\Disco\Annotations\Configuration;

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
     * @return array <string|array> - многомерняй массив с параметрами указанных в config/config.yaml
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
        return new Users(Kernel::getInstance());
    }
}
