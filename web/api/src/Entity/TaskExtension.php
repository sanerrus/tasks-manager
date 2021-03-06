<?php
/**
 * Сущность комментариев к задаче
 * PHP version 7.4.
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
 * @ORM\Table(name="task_extension", indexes={@ORM\Index(name="fk_tasks_1_idx", columns={"users_id"}), @ORM\Index(name="fk_tasks_2_idx", columns={"task_statuses_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\TaskExtensionRepository")
 */
class TaskExtension implements EntityInterface
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
     * @ORM\Column(name="description", type="string", length=2048)
     */
    private $description;

    // Что то не так со связями
    /**
     * @var int
     *
     * @ORM\Column(name="tasks_id", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $tasks;

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

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getTasks(): int
    {
        return $this->tasks;
    }

    public function setTasks(Tasks $tasks): void
    {
        $this->tasks = $tasks;
    }

    public function getCreateAt(): \DateTimeInterface
    {
        return $this->createAt;
    }

    public function setCreateAt(\DateTimeInterface $createAt): void
    {
        $this->createAt = $createAt;
    }

    public function getUpdateAt(): ?\DateTimeInterface
    {
        return $this->updateAt;
    }

    public function setUpdateAt(\DateTimeInterface $updateAt): void
    {
        $this->updateAt = $updateAt;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'description' => $this->getDescription(),
            'tasks' => $this->getTasks(),
            'createAt' => $this->getCreateAt()->format('Y-m-d H:i'),
            'updateAt' => $this->getUpdateAt() ? $this->getUpdateAt()->format('Y-m-d H:i') : '',
        ];
    }
}
