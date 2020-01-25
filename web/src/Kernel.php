<?php
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
use bitExpert\Disco\AnnotationBeanFactory;
use bitExpert\Disco\BeanFactoryRegistry;
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
    /**
     * Контейнер приложения.
     *
     * @var ContainerInterface
     */
    private ContainerInterface $container;

    /**
     * Запускаем приложение, производим первоначальные настройки.
     */
    public function run(): void
    {
        $this->container = new AnnotationBeanFactory(AppConfiguration::class);
        BeanFactoryRegistry::register($this->container);
    }

    /**
     * Возвращает контейнер приложения.
     */
    public function getContainer(): ContainerInterface
    {
        return $this->container;
    }
}
