<?php

declare(strict_types=1);
/**
 * Репозиторий комментариев к задачам
 * PHP version 7.4.1.
 *
 * @category Application
 *
 * @author  sanerrus <username@example.com>
 * @license MIT http://www.example.com/License.tx
 *
 * @see http://www.example.com/Document.tx
 */

namespace App\Repository;

use App\Entity\EntityInterface;
use App\Entity\TaskExtension;
use App\Exceptions\InvalidArgumentException;
use Doctrine\ORM\EntityRepository;

class TaskExtensionRepository extends EntityRepository implements CrudInterface, RepositoryInterface
{
    /**
     * Добавляем сущность в БД.
     *
     * @param TaskExtension $taskExtension
     *
     * @throws InvalidArgumentException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function create(EntityInterface $taskExtension): TaskExtension
    {
        if (!($taskExtension instanceof TaskExtension) || $taskExtension->getId()) {
            throw new InvalidArgumentException('В TaskExtensionRepository->create(...) переданы некорректные данные');
        }

        $this->getEntityManager()
            ->persist($taskExtension);
        $this->getEntityManager()
            ->flush($taskExtension);

        return $taskExtension;
    }

    /**
     * Обновляем сущность в БД.
     *
     * @param TaskExtension $taskExtension
     *
     * @throws InvalidArgumentException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function update(EntityInterface $taskExtension): TaskExtension
    {
        if (!($taskExtension instanceof TaskExtension) || !$taskExtension->getId()) {
            throw new InvalidArgumentException('В TaskExtensionRepository->update(...) переданы некорректные данные');
        }

        $this->getEntityManager()
            ->flush($taskExtension);

        return $taskExtension;
    }

    /**
     * Удаляем сущность из БД.
     *
     * @param TaskExtension $taskExtension
     *
     * @throws InvalidArgumentException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function remove(EntityInterface $taskExtension): CrudInterface
    {
        if (!($taskExtension instanceof TaskExtension) || !$taskExtension->getId()) {
            throw new InvalidArgumentException('В TaskExtensionRepository->remove(...) переданы некорректные данные');
        }

        $this->getEntityManager()
            ->remove($taskExtension);
        $this->getEntityManager()
            ->flush($taskExtension);

        return $this;
    }

    /**
     * Возвращать массив с ключами по указанному полю.
     *
     * @param string $key - поле которое будет ключем возвращаемого массива
     *
     * @return array <int|string, EntityInterface>
     */
    public function getAllWithSpecifiedKey(string $key = 'id'): array
    {
        return $this->createQueryBuilder('TaskExtension', 'TaskExtension.'.$key)
            ->getQuery()
            ->getResult();
    }
}
