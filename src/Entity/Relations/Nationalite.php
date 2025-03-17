<?php

namespace App\Entity\Relations;

use App\Repository\Relations\NationaliteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
#[ORM\Table(name: 'rel_nationalites')]
#[ORM\Entity(repositoryClass: NationaliteRepository::class)]
class Nationalite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    /**
     * @var Collection<int, Habitant>
     */
    #[ORM\ManyToMany(targetEntity: Habitant::class, mappedBy: 'nationalites')]
    private Collection $habitants;

    public function __construct()
    {
        $this->habitants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection<int, Habitant>
     */
    public function getHabitants(): Collection
    {
        return $this->habitants;
    }

    public function addHabitant(Habitant $habitant): static
    {
        if (!$this->habitants->contains($habitant)) {
            $this->habitants->add($habitant);
            $habitant->addNationalite($this);
        }

        return $this;
    }

    public function removeHabitant(Habitant $habitant): static
    {
        if ($this->habitants->removeElement($habitant)) {
            $habitant->removeNationalite($this);
        }

        return $this;
    }
}
