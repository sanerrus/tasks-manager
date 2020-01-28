<?php
/**
 * Сервис работы с задачами
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

namespace App\Services\Tasks;

use App\Entity\EntityInterface;
use App\Entity\Tasks as Task;
use App\Services\AbstractWorkWithData;
use App\Services\Tasks\TaskExtension\TaskExtensionInterface;
use Doctrine\ORM\EntityManager;

/**
 * Сервис работы с задачами.
 *
 * Class Tasks
 */
class Tasks extends AbstractWorkWithData implements TasksInterface
{
    /**
     * Менеджер работы с БД.
     *
     * @var EntityManager
     *
     * @Inject entityManager
     */
    protected EntityManager $em;

    /**
     * Сервис работы с комментариями к задаче.
     *
     * @var TaskExtensionInterface
     *
     * @Inject taskExtension
     */
    protected TaskExtensionInterface $taskExtension;

    public function findBy(array $criteria): array
    {
        return $this->em->getRepository(Task::class)->findBy($criteria);
    }

    public function findAll(): array
    {
        return $this->em->getRepository(Task::class)->findAll();
    }

    public function update(EntityInterface $entity): void
    {
        $this->em->getRepository(Task::class)->update($entity);
    }

    public function remove(EntityInterface $entity): void
    {
        $this->em->getRepository(Task::class)->remove($entity);
    }

    public function create(EntityInterface $entity): EntityInterface
    {
        return $this->em->getRepository(Task::class)->create($entity);
    }

    /**
     * {@inheritdoc}
     */
    public function getTaskExtension(int $tasksId): array
    {
        return $this->taskExtension->findByTasks($tasksId);
    }
}
