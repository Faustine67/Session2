<?php

namespace App\Entity;

use App\Repository\ProgrammationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProgrammationRepository::class)]
class Programmation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'programmations')]
    private ?Module $module = null;

    #[ORM\ManyToOne(inversedBy: 'programmations')]
    private ?Session $session = null;

    #[ORM\Column]
    private ?int $nombreJours = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModule(): ?Module
    {
        return $this->module;
    }

    public function setModule(?Module $module): self
    {
        $this->module = $module;

        return $this;
    }

    public function getSession(): ?Session
    {
        return $this->session;
    }

    public function setSession(?Session $session): self
    {
        $this->session = $session;

        return $this;
    }

    public function getNombreJours(): ?int
    {
        return $this->nombreJours;
    }

    public function setNombreJours(int $nombreJours): self
    {
        $this->nombreJours = $nombreJours;

        return $this;
    }
}
