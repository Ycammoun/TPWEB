<?php

namespace App\Entity\Relations;

use App\Repository\Relations\HabitantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
#[ORM\Table(name: 'rel_habitants')]
#[ORM\Entity(repositoryClass: HabitantRepository::class)]
class Habitant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\OneToOne(targetEntity: Permis::class, inversedBy: 'habitant' ,cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(
        name: 'id_permis',
        referencedColumnName: 'id',
        nullable: true,
    )]

    private ?Permis $permis = null;

    #[ORM\ManyToOne(targetEntity: Ville::class ,inversedBy: 'habitants')]
    #[ORM\JoinColumn(
        name: 'id_ville',
        referencedColumnName: 'id',
        nullable: true,
    )]
    private ?Ville $ville = null;

    /**
     * @var Collection<int, Nationalite>
     */
    #[ORM\ManyToMany(targetEntity: Nationalite::class, inversedBy: 'habitants')]
    #[ORM\JoinTable(name: 'rel_asso_habitant_nationalite')]
    #[ORM\JoinColumn(
        name: 'id_habitant',
        referencedColumnName: 'id',
        nullable: true,
    )]
    #[ORM\InverseJoinColumn(
        name: 'id_nationalite',
        referencedColumnName: 'id',
        nullable: false,
    )]

    private Collection $nationalites;

    public function __construct()
    {
        $this->nationalites = new ArrayCollection();
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

    public function getPermis(): ?Permis
    {
        return $this->permis;
    }

    public function setPermis(?Permis $permis): static
    {
        $this->permis = $permis;

        return $this;
    }

    public function getVille(): ?Ville
    {
        return $this->ville;
    }

    public function setVille(?Ville $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * @return Collection<int, Nationalite>
     */
    public function getNationalites(): Collection
    {
        return $this->nationalites;
    }

    public function addNationalite(Nationalite $nationalite): static
    {
        if (!$this->nationalites->contains($nationalite)) {
            $this->nationalites->add($nationalite);
        }

        return $this;
    }

    public function removeNationalite(Nationalite $nationalite): static
    {
        $this->nationalites->removeElement($nationalite);

        return $this;
    }
}
