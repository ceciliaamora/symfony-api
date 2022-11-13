<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class Lecture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $date = null;

    // #[ORM\Column(type: Types::DATE_MUTABLE, nullable:true)]
    // private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne(targetEntity: Event::class)]
    #[ORM\JoinColumn(name: 'event_id', referencedColumnName:'id')]
    private Event $event;

    // #[ORM\Column(type: Types::TIME_MUTABLE, nullable:true)]
    // private ?\DateTimeInterface $start_time = null;
    #[ORM\Column(length: 10, nullable: true)]
    private ?string $start_time = null;

    // #[ORM\Column(type: Types::TIME_MUTABLE, nullable:true)]
    // private ?\DateTimeInterface $end_time = null;
    #[ORM\Column(length: 10, nullable: true)]
    private ?string $end_time = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    // #[ORM\OneToMany(mappedBy: 'lecture', targetEntity: User::class)]
    // private Collection $user;

    public function __construct()
    {
        $this->user = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getEventId(): ?Event
    {
        return $this->event;
    }

    public function setEventId(Event $event): void
    {
        $this->event = $event;
    }

    public function getStartTime(): ?string
    {
        return $this->start_time;
    }

    public function setStartTime(string $start_time): self
    {
        $this->start_time = $start_time;

        return $this;
    }

    public function getEndTime(): ?string
    {
        return $this->end_time;
    }

    public function setEndTime(string $end_time): self
    {
        $this->end_time = $end_time;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    // /**
    //  * @return Collection<int, User>
    //  */
    // public function getUser(): Collection
    // {
    //     return $this->user;
    // }

}
