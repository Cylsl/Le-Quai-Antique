<?php

namespace App\Entity;

use App\Repository\LimitReservationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LimitReservationRepository::class)]
class LimitReservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $limite = null;

    #[ORM\Column]
    private ?int $limit_hour = null;

    #[ORM\Column]
    private ?int $time = null;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLimite(): ?int
    {
        return $this->limite;
    }

    public function setLimite(int $limite): self
    {
        $this->limite = $limite;

        return $this;
    }

    public function getLimitHour(): ?int
    {
        return $this->limit_hour;
    }

    public function setLimitHour(int $limit_hour): self
    {
        $this->limit_hour = $limit_hour;

        return $this;
    }

    public function getTime(): ?int
    {
        return $this->time;
    }

    public function setTime(int $time): self
    {
        $this->time = $time;

        return $this;
    }
}
