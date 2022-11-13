<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true, options:["default" => "CURRENT_TIMESTAMP"])]
    private ?\DateTimeInterface $startDateTime = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true, options:["default" => "CURRENT_TIMESTAMP"])]
    private ?\DateTimeInterface $endDateTime = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 100)]
    #[Assert\Choice(['Agendado', 'Acontecendo', 'Finalizado', 'Cancelado'])]
    private ?string $status = null;

    #[ORM\OneToMany(mappedBy: 'event', targetEntity: Lecture::class)]
    private Collection $lectures;

    public function __construct()
    {
        $this->lectures = new ArrayCollection();
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

    public function getStartDateTime(): ?\DateTimeInterface
    {
        return $this->startDateTime;
    }

    public function setStartDateTime(\DateTimeInterface $startDateTime): self
    {
        $this->startDateTime = $startDateTime;

        return $this;
    }

    public function getEndDateTime(): ?\DateTimeInterface
    {
        return $this->endDateTime;
    }

    public function setEndDateTime(\DateTimeInterface $endDateTime): self
    {
        $this->endDateTime = $endDateTime;

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

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    // /**
    //  * @return Collection<int, Lecture>
    //  */
    // public function getLectures(): Collection
    // {
    //     return $this->lectures;
    // }

    // public function addLecture(Lecture $lecture): self
    // {
    //     if (!$this->lectures->contains($lecture)) {
    //         $this->lectures->add($lecture);
    //         $lecture->setEventId($this);
    //     }

    //     return $this;
    // }

    // public function removeLecture(Lecture $lecture): self
    // {
    //     if ($this->lectures->removeElement($lecture)) {
    //         // set the owning side to null (unless already changed)
    //         if ($lecture->getEventId() === $this) {
    //             $lecture->setEventId(null);
    //         }
    //     }

    //     return $this;
    // }
}
