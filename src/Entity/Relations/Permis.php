<?php

namespace App\Entity\Relations;

use App\Repository\Relations\PermisRepository;
use Doctrine\ORM\Mapping as ORM;
#[ORM\Table(name: 'rel_permis')]
#[ORM\Entity(repositoryClass: PermisRepository::class)]
class Permis
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $prefecture = null;
    #[ORM\OneToOne(targetEntity: Habitant::class, mappedBy: 'permis', cascade: ['persist', 'remove'])]
    private ?Habitant $habitant = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrefecture(): ?string
    {
        return $this->prefecture;
    }

    public function setPrefecture(string $prefecture): static
    {
        $this->prefecture = $prefecture;

        return $this;
    }
}
