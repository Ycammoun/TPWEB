<?php

namespace App\Entity\Sandbox;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;



use App\Repository\Sandbox\FilmRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'sb_films')]
#[ORM\Entity(repositoryClass: FilmRepository::class)]
class Film
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 200)]
    #[Assert\NotBlank]
    #[Assert\Lengh(
        max : 200,
        maxMessage: 'La taille du titre est trop grande ; la limite est {{ limit }}',


    )]
    private ?string $titre = null;

    #[ORM\Column(options: ['comment'=>'année de sortie'])]
    #[Assert\Range(
        minMessage: 'Avant {{ limit }} le cinéma n\'existait pas',
        min: 1850,
    )]
    #[Assert\Range(
        maxMessage: '{{ value }} est trop loin dans le futur, après {{ limit }} ...',
        max: 2053,
    )]
    private ?int $annee = null;

    #[ORM\Column(name: 'enstock', type: Types::BOOLEAN, options: [ 'default' => true])]
    #[Assert\Type(
        type: 'boolean',
        message: '{{ value }} n\'est pas de type {{ type }}',
    )]

    private ?bool $enstock = null;

    #[ORM\Column]
    #[Assert\Range(
        notInRangeMessage: 'le prix doit être compris entre {{ min }} et {{ max }}',
        min: 1,
        max: 9999.99,
    )]

    private ?float $prix = null;

    #[ORM\Column(nullable: true)]
    private ?int $quantite = null;

    /**
     * @var Collection<int, Critique>
     */
    #[ORM\OneToMany(targetEntity: Critique::class, mappedBy: 'film')]
    #[ASSERT\Valid]
    private Collection $critiques;


    /**
     * Film constructor
     */
    public function __construct()
    {
        $this->enstock = true;
        $this->quantite = null;
        $this->critiques = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

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

    public function isEnstock(): ?bool
    {
        return $this->enstock;
    }

    public function setEnstock(bool $enstock): static
    {
        $this->enstock = $enstock;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(?int $quantite): static
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * @return Collection<int, Critique>
     */
    public function getCritiques(): Collection
    {
        return $this->critiques;
    }

    public function addCritique(Critique $critique): static
    {
        if (!$this->critiques->contains($critique)) {
            $this->critiques->add($critique);
            $critique->setFil($this);
        }

        return $this;
    }

    public function removeCritique(Critique $critique): static
    {
        if ($this->critiques->removeElement($critique)) {
            // set the owning side to null (unless already changed)
            if ($critique->getFil() === $this) {
                $critique->setFil(null);
            }
        }

        return $this;
    }
    #[Assert\Callback]
    public function verifStock(ExecutionContextInterface $context): void
    {
        if (   (($this->enstock === false) && (is_null($this->quantite) || ($this->quantite > 0)))
            || (($this->enstock === true) && (! is_null($this->quantite)) && ($this->quantite <= 0)))
        {
            $context
                ->buildViolation('incohérence entre quantite et enstock')
                ->atPath('quantite')
                ->addViolation();
        }

    }
}
