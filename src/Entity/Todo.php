<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Mapping\ClassMetadata;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TodoRepository")
 * @ORM\Table(name="todos")
 */
class Todo
{

    public function __construct()
    {
        $this -> created = new \DateTime();
        $this -> updated = new \DateTime();
        $this -> deleted = 0;
    }

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $sent_emails;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated;

    /**
     * @ORM\Column(type="datetime")
     */
    private $reminder;

    /**
     * @ORM\Column(type="datetime")
     */
    private $last_sent;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $reminder_intervals;

    /**
     * @ORM\Column(type="boolean")
     */
    private $deleted;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getSentEmails(): ?string
    {
        return $this->sent_emails;
    }

    public function setSentEmails(?string $sent_emails): self
    {
        $this->sent_emails = $sent_emails;

        return $this;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }

    public function getUpdated(): ?\DateTimeInterface
    {
        return $this->updated;
    }

    public function setUpdated(\DateTimeInterface $updated): self
    {
        $this->updated = $updated;

        return $this;
    }

    public function getReminder(): ?\DateTimeInterface
    {
        return $this->reminder;
    }

    public function setReminder(\DateTimeInterface $reminder): self
    {
        $this->reminder = $reminder;

        return $this;
    }

    public function getReminderIntervals(): ?string
    {
        return $this->reminder_intervals;
    }

    public function setReminderIntervals(?string $reminder_intervals): self
    {
        $this->reminder_intervals = $reminder_intervals;

        return $this;
    }

    public function getLastSent(): ?\DateTimeInterface
    {
        return $this->last_sent;
    }

    public function setLastSent(\DateTimeInterface $last_sent): self
    {
        $this->last_sent = $last_sent;

        return $this;
    }

    public function getDeleted(): ?bool
    {
        return $this->deleted;
    }

    public function setDeleted(bool $deleted): self
    {
        $this->deleted = $deleted;

        return $this;
    }
}
