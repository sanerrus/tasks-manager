<?php

/**
 * Интерфейс CRUD задач
 * PHP version 7.4.1.
 *
 * @category Application
 *
 * @author  sanerrus <username@example.com>
 * @license MIT http://www.example.com/License.txt
 *
 * @see http://www.example.com/Document.txt
 */

namespace App\Repository;

use App\Entity\EntityInterface;
use App\Exceptions\InvalidArgumentException;

interface CrudInterface
{
    /**
     * Добавляем сущность в БД.
     *
     * @throws InvalidArgumentException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function create(EntityInterface $entity): EntityInterface;

    /**
     * Обновляем сущность в БД.
     *
     * @throws InvalidArgumentException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function update(EntityInterface $entity): EntityInterface;

    /**
     * Удаляем сущность из БД.
     *
     * @throws InvalidArgumentException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function remove(EntityInterface $entity): CrudInterface;
}
