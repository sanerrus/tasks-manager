<?php
/**
 * Конфигурация контенера приложения
 * PHP version 7.4.1.
 *
 * @category Application
 *
 * @author   sanerrus <username@example.com>
 * @license  MIT http://www.example.com/License.tx
 *
 * @see     http://www.example.com/Document.tx
 */

namespace App\Configuration;

use App\Services\SimpleService;
use bitExpert\Disco\Annotations\Bean;
use bitExpert\Disco\Annotations\Configuration;

/**
 * Основной класс конфигурации.
 *
 * @category Application
 *
 * @author   sanerrus <username@example.com>
 * @license  MIT http://www.example.com/License.tx
 *
 * @see     http://www.example.com/Document.tx
 *
 * @Configuration
 */
class AppConfiguration
{
    /**
     * Тестовый сервис в контейнере.
     *
     * @Bean
     */
    public function mySimpleService(): SimpleService
    {
        return new SimpleService();
    }
}
