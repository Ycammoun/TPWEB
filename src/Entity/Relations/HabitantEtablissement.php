<?php

namespace App\Entity\Relations;

use App\Repository\Relations\HabitantEtablissementRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'rel_asso_habitants_etablissements')]
#[ORM\UniqueConstraint(columns: ['id_habitant', 'id_etablissement', 'annee'])]
#[ORM\Entity(repositoryClass: HabitantEtablissementRepository::class)]
class HabitantEtablissement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Habitant::class)]
    #[ORM\JoinColumn(name: 'id_habitant', nullable: false)]
    private ?Habitant $habitant = null;

    #[ORM\ManyToOne(targetEntity: Etablissement::class, inversedBy: 'habitantEtablissements')]
    #[ORM\JoinColumn(name: 'id_etablissement', nullable: false)]
    private ?Etablissement $etablissement = null;

    #[ORM\Column(type: Types::INTEGER)]
    private ?int $annee = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHabitant(): ?Habitant
    {
        return $this->habitant;
    }

    public function setHabitant(?Habitant $habitant): static
    {
        $this->habitant = $habitant;

        return $this;
    }

    public function getEtablissement(): ?Etablissement
    {
        return $this->etablissement;
    }

    public function setEtablissement(?Etablissement $etablissement): static
    {
        $this->etablissement = $etablissement;

        return $this;
    }

    public function getAnnee(): ?int
    {
        return $this->annee;
    }

    public function setAnnee(int $annee): static
    {
        $this->annee = $annee;

        return $this;
    }
}
