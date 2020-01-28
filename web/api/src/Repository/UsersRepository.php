<?php
/**
 * Репозиторий пользователей системы
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
use App\Entity\Users;
use App\Exceptions\InvalidArgumentException;
use Doctrine\ORM\EntityRepository;

class UsersRepository extends EntityRepository implements CrudInterface, RepositoryInterface
{
    /**
     * Добавляем сущность в БД.
     *
     * @param Users $users
     *
     * @throws InvalidArgumentException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function create(EntityInterface $users): Users
    {
        if (!($users instanceof Users) || $users->getId()) {
            throw new InvalidArgumentException('В UsersRepository->create(...) переданы некорректные данные');
        }

        $this->getEntityManager()
            ->persist($users);
        $this->getEntityManager()
            ->flush($users);

        return $users;
    }

    /**
     * Обновляем сущность в БД.
     *
     * @param Users $users
     *
     * @throws InvalidArgumentException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function update(EntityInterface $users): Users
    {
        if (!($users instanceof Users) || !$users->getId()) {
            throw new InvalidArgumentException('В UsersRepository->update(...) переданы некорректные данные');
        }

        $this->getEntityManager()
            ->flush($users);

        return $users;
    }

    /**
     * Удаляем сущность из БД.
     *
     * @param Users $users
     *
     * @throws InvalidArgumentException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function remove(EntityInterface $users): CrudInterface
    {
        if (!($users instanceof Users) || !$users->getId()) {
            throw new InvalidArgumentException('В UsersRepository->remove(...) переданы некорректные данные');
        }

        $this->getEntityManager()
            ->remove($users);
        $this->getEntityManager()
            ->flush($users);

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
        return $this->createQueryBuilder('Users', 'Users.'.$key)
            ->getQuery()
            ->getResult();
    }
}
