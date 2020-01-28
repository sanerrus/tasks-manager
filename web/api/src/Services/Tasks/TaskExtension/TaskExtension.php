<?php
/**
 * Сервис работы с комментариями к задачам
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

namespace App\Services\Tasks\TaskExtension;

use App\Entity\EntityInterface;
use App\Entity\TaskExtension as TaskExt;
use App\Services\AbstractWorkWithData;
use Doctrine\ORM\EntityManager;

/**
 * Сервис работы с комментариями к задачам
 *
 * Class TaskExtension
 */
class TaskExtension extends AbstractWorkWithData implements TaskExtensionInterface
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
        return $this->em->getRepository(TaskExt::class)->findBy($criteria);
    }

    public function findAll(): array
    {
        return $this->em->getRepository(TaskExt::class)->findAll();
    }

    public function update(EntityInterface $entity): void
    {
        $this->em->getRepository(TaskExt::class)->update($entity);
    }

    public function remove(EntityInterface $entity): void
    {
        $this->em->getRepository(TaskExt::class)->remove($entity);
    }

    public function create(EntityInterface $entity): EntityInterface
    {
        return $this->em->getRepository(TaskExt::class)->create($entity);
    }
}
