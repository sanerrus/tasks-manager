<?php
/**
 * Репозиторий статусов задач
 * PHP version 7.4.1.
 *
 * @category Application
 *
 * @author  sanerrus <username@example.com>
 * @license MIT http://www.example.com/License.txt
 *
 * @see http://www.example.com/Document.txt
 */
declare(strict_types=1);

namespace App\Repository;

use App\Entity\EntityInterface;
use App\Entity\TaskStatuses;
use App\Exceptions\InvalidArgumentException;
use Doctrine\ORM\EntityRepository;

class TaskStatusesRepository extends EntityRepository implements CrudInterface, RepositoryInterface
{
    /**
     * Добавляем сущность в БД.
     *
     * @param TaskStatuses $taskStatuses
     *
     * @throws InvalidArgumentException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function create(EntityInterface $taskStatuses): TaskStatuses
    {
        if (!($taskStatuses instanceof TaskStatuses) || $taskStatuses->getId()) {
            throw new InvalidArgumentException('В TaskStatusesRepository->create(...) переданы некорректные данные');
        }

        $this->getEntityManager()
            ->persist($taskStatuses);
        $this->getEntityManager()
            ->flush($taskStatuses);

        return $taskStatuses;
    }

    /**
     * Обновляем сущность в БД.
     *
     * @param TaskStatuses $taskStatuses
     *
     * @throws InvalidArgumentException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function update(EntityInterface $taskStatuses): TaskStatuses
    {
        if (!($taskStatuses instanceof TaskStatuses) || !$taskStatuses->getId()) {
            throw new InvalidArgumentException('В TaskStatusesRepository->update(...) переданы некорректные данные');
        }

        $this->getEntityManager()
            ->flush($taskStatuses);

        return $taskStatuses;
    }

    /**
     * Удаляем сущность из БД.
     *
     * @param TaskStatuses $taskStatuses
     *
     * @throws InvalidArgumentException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function remove(EntityInterface $taskStatuses): CrudInterface
    {
        if (!($taskStatuses instanceof TaskStatuses) || !$taskStatuses->getId()) {
            throw new InvalidArgumentException('В TaskStatusesRepository->remove(...) переданы некорректные данные');
        }

        $this->getEntityManager()
            ->remove($taskStatuses);
        $this->getEntityManager()
            ->flush($taskStatuses);

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
        return $this->createQueryBuilder('TaskStatuses', 'TaskStatuses.'.$key)
            ->getQuery()
            ->getResult();
    }
}
