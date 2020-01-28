<?php
/**
 * Абстрактный класс реализующий и определяющий работу с данными
 * реализация методы findBy, findAll, update, remove и create возложено на дочернии классы
 * т.к. в этих методах вероятно потребуется индивидуальная работа с данными
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

namespace App\Services;

use App\AbstractInjector;
use App\Entity\EntityInterface;
use App\Exceptions\InvalidArgumentException;

abstract class AbstractWorkWithData extends AbstractInjector
{
    /**
     * Получаем данные по условиям
     *
     * @param array <int|string|\DateTimeInterface> $criteria - критерии выборки
     *
     * @return array <EntityInterface>
     */
    abstract public function findBy(array $criteria): array;

    /**
     * Получение всех данных.
     *
     * @return array <EntityInterface>
     */
    abstract public function findAll(): array;

    /**
     * Обновление c сохранениее сущности.
     */
    abstract public function update(EntityInterface $entity): void;

    /**
     * Удаление сущности.
     */
    abstract public function remove(EntityInterface $entity): void;

    /**
     * Создание с сохранением сущности.
     */
    abstract public function create(EntityInterface $entity): EntityInterface;

    /**
     * Волшебный метод. Реализован для:
     * 1. корректной работе при определении поля поиска в названии метода.
     *
     * @param string $method    - полное название метода
     * @param mixed  $arguments
     *
     * @return array <EntityInterface>
     *
     * @throws InvalidArgumentException
     */
    public function __call(string $method, $arguments): array
    {
        if (0 === strpos($method, 'findBy')) {
            return $this->resolveMagicCall('findBy', substr($method, 6), $arguments);
        }

        throw new \BadMethodCallException("Undefined method '$method'. The method name must start with ".'findBy!');
    }

    /**
     * Вспомогательный метод для self::__call().
     *
     * @param string $method    - вызываемый метод
     * @param string $by        - поле поиска
     * @param mixed  $arguments - значение для поиска
     *
     * @return array <EntityInterface>
     *
     * @throws InvalidArgumentException
     */
    private function resolveMagicCall(string $method, string $by, $arguments): array
    {
        if (!$arguments) {
            throw new InvalidArgumentException('Users::resolveMagicCall(): не переданы аргументы');
        }

        $fieldName = lcfirst($by);

        return $this->$method([$fieldName => $arguments[0]]);
    }
}
