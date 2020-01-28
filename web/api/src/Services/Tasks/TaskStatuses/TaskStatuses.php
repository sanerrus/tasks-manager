<?php
/**
 * Сервис работы со статусами задачи
 * PHP version 7.4.1.
 *
 * @category Application
 *
 * @author  sanerrus <Taskname@example.com>
 * @license MIT http://www.example.com/License.txt
 *
 * @see http://www.example.com/Document.txt
 */
declare(strict_types=1);

namespace App\Services\Tasks\TaskStatuses;

use App\Entity\EntityInterface;
use App\Entity\TaskStatuses as TaskStatus;
use App\Services\AbstractWorkWithData;
use Doctrine\ORM\EntityManager;

/**
 * Сервис работы со статусами задачи.
 *
 * Class TaskStatuses
 */
class TaskStatuses extends AbstractWorkWithData implements TaskStatusesInterface
{
    /**
     * Менеджер работы с БД.
     *
     * @var EntityManager
     *
     * @Inject entityManager
     */
    protected EntityManager $em;

    public function findBy(array $criteria): array
    {
        return $this->em->getRepository(TaskStatus::class)->findBy($criteria);
    }

    public function findAll(): array
    {
        return $this->em->getRepository(TaskStatus::class)->findAll();
    }

    public function update(EntityInterface $entity): void
    {
        $this->em->getRepository(TaskStatus::class)->update($entity);
    }

    public function remove(EntityInterface $entity): void
    {
        $this->em->getRepository(TaskStatus::class)->remove($entity);
    }

    public function create(EntityInterface $entity): EntityInterface
    {
        return $this->em->getRepository(TaskStatus::class)->create($entity);
    }
}
