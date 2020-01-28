<?php
/**
 * Сервис работы с пользователями
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

namespace App\Services\Users;

use App\Entity\EntityInterface;
use App\Entity\Users as User;
use App\Services\AbstractWorkWithData;
use Doctrine\ORM\EntityManager;

class Users extends AbstractWorkWithData implements UsersInterface
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
        return $this->em->getRepository(User::class)->findBy($criteria);
    }

    public function findAll(): array
    {
        return $this->em->getRepository(User::class)->findAll();
    }

    public function update(EntityInterface $entity): void
    {
        $this->em->getRepository(User::class)->update($entity);
    }

    public function remove(EntityInterface $entity): void
    {
        $this->em->getRepository(User::class)->remove($entity);
    }

    public function create(EntityInterface $entity): EntityInterface
    {
        return $this->em->getRepository(User::class)->create($entity);
    }
}
