<?php

namespace App\Entity\Sandbox;

use App\Repository\Sandbox\CritiqueRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\DependencyInjection\Attribute\Target;

#[ORM\Table(name: 'sb_critiques')]
#[ORM\Entity(repositoryClass: CritiqueRepository::class)]
class Critique
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true,options: ['default' => null, 'comment'=> 'entre 0 et 5'],)]
    private ?int $note = null;

    #[ORM\Column(type: Types::TEXT ,length: 255)]
    private ?string $avis = null;

    #[ORM\ManyToOne(targetEntity: Film::class,inversedBy: 'critiques')]
    #[ORM\JoinColumn(name: 'id_film',nullable: false)]
    private ?Film $film = null;

    public function __construct(){
        $this->note = null;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(?int $note): static
    {
        $this->note = $note;

        return $this;
    }

    public function getAvis(): ?string
    {
        return $this->avis;
    }

    public function setAvis(string $avis): static
    {
        $this->avis = $avis;

        return $this;
    }

    public function getFil(): ?Film
    {
        return $this->film;
    }

    public function setFil(?Film $film): static
    {
        $this->fil = $film;

        return $this;
    }
}
