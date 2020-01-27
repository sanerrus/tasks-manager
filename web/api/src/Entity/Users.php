<?php
/**
 * Сущность пользователей системы
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

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Users.
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="App\Repository\UsersRepository")
 */
class Users implements EntityInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=64, nullable=false)
     */
    private $name;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=false)
     */
    private $isActive;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): void
    {
        $this->isActive = $isActive;
    }
}
