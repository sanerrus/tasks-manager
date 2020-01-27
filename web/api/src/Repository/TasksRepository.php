<?php
/**
 * Репозиторий задач
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

namespace App\Repository;

use App\Entity\EntityInterface;
use App\Entity\Tasks;
use App\Exceptions\InvalidArgumentException;
use Doctrine\ORM\EntityRepository;

class TasksRepository extends EntityRepository implements CrudInterface, RepositoryInterface
{
    /**
     * Добавляем сущность в БД.
     *
     * @param Tasks $tasks
     *
     * @throws InvalidArgumentException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function create(EntityInterface $tasks): Tasks
    {
        if (!($tasks instanceof Tasks) || $tasks->getId()) {
            throw new InvalidArgumentException('В TasksRepository->create(...) переданы некорректные данные');
        }

        $this->getEntityManager()
            ->persist($tasks);
        $this->getEntityManager()
            ->flush($tasks);

        return $tasks;
    }

    /**
     * Обновляем сущность в БД.
     *
     * @param Tasks $tasks
     *
     * @throws InvalidArgumentException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function update(EntityInterface $tasks): Tasks
    {
        if (!($tasks instanceof Tasks) || !$tasks->getId()) {
            throw new InvalidArgumentException('В TasksRepository->update(...) переданы некорректные данные');
        }

        $this->getEntityManager()
            ->flush($tasks);

        return $tasks;
    }

    /**
     * Удаляем сущность из БД.
     *
     * @param Tasks $tasks
     *
     * @throws InvalidArgumentException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function remove(EntityInterface $tasks): CrudInterface
    {
        if (!($tasks instanceof Tasks) || !$tasks->getId()) {
            throw new InvalidArgumentException('В TasksRepository->remove(...) переданы некорректные данные');
        }

        $this->getEntityManager()
            ->remove($tasks);
        $this->getEntityManager()
            ->flush($tasks);

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
        return $this->createQueryBuilder('Tasks', 'Tasks.'.$key)
            ->getQuery()
            ->getResult();
    }
}
