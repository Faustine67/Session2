<?php

namespace App\Entity;

use App\Repository\ModuleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModuleRepository::class)]
class Module
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $details = null;

    #[ORM\ManyToOne(inversedBy: 'modules')]
    private ?Categorie $categorie = null;

    #[ORM\Column(length: 255)]
    private ?string $ManyToOne = null;

    #[ORM\OneToMany(mappedBy: 'module', targetEntity: Programmation::class)]
    private $programmations;

    public function __construct()
    {
        $this->programmations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDetails(): ?string
    {
        return $this->details;
    }

    public function setDetails(string $details): self
    {
        $this->details = $details;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getManyToOne(): ?string
    {
        return $this->ManyToOne;
    }

    public function setManyToOne(string $ManyToOne): self
    {
        $this->ManyToOne = $ManyToOne;

        return $this;
    }

    /**
     * @return Collection<int, Programmation>
     */
    public function getProgrammations(): Collection
    {
        return $this->programmations;
    }

    public function addProgrammation(Programmation $programmation): self
    {
        if (!$this->programmations->contains($programmation)) {
            $this->programmations->add($programmation);
            $programmation->setModule($this);
        }

        return $this;
    }

    public function removeProgrammation(Programmation $programmation): self
    {
        if ($this->programmations->removeElement($programmation)) {
            // set the owning side to null (unless already changed)
            if ($programmation->getModule() === $this) {
                $programmation->setModule(null);
            }
        }

        return $this;
    }
}
