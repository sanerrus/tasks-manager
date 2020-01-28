<?php
/**
 * Сущность задач
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

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tasks.
 *
 * @ORM\Table(name="tasks", indexes={@ORM\Index(name="fk_tasks_1_idx", columns={"users_id"}), @ORM\Index(name="fk_tasks_2_idx", columns={"task_statuses_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\TasksRepository")
 */
class Tasks implements EntityInterface
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
     * @ORM\Column(name="name", type="string", length=256, nullable=false)
     */
    private $name;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_open", type="boolean", nullable=false)
     */
    private $isOpen;

    // От связей отказался в пользу отказа от множества запросов к БД (см. логику работы с структурами)
    /**
     * @var int
     *
     * @ORM\Column(name="users_id", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $users;

    // От связей отказался в пользу отказа от множества запросов к БД (см. логику работы с структурами)
    /**
     * @var int
     *
     * @ORM\Column(name="task_statuses_id", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $taskStatuses;

    /**
     * @var \DateTimeInterface
     *
     * @ORM\Column(name="create_at", type="datetime", nullable=false)
     */
    private $createAt;

    /**
     * @var \DateTimeInterface
     *
     * @ORM\Column(name="update_at", type="datetime", nullable=false)
     */
    private $updateAt;

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

    public function isOpen(): bool
    {
        return $this->isOpen;
    }

    public function setIsOpen(bool $isOpen): void
    {
        $this->isOpen = $isOpen;
    }

    public function getUsers(): int
    {
        return $this->users;
    }

    public function setUsers(int $users): void
    {
        $this->users = $users;
    }

    public function getTaskStatuses(): int
    {
        return $this->taskStatuses;
    }

    public function setTaskStatuses(int $taskStatuses): void
    {
        $this->taskStatuses = $taskStatuses;
    }

    public function getCreateAt(): \DateTimeInterface
    {
        return $this->createAt;
    }

    public function setCreateAt(\DateTimeInterface $createAt): void
    {
        $this->createAt = $createAt;
    }

    public function getUpdateAt(): \DateTimeInterface
    {
        return $this->updateAt;
    }

    public function setUpdateAt(\DateTimeInterface $updateAt): void
    {
        $this->updateAt = $updateAt;
    }
}
