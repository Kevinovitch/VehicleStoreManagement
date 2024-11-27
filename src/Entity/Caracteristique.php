<?php

namespace App\Entity;


use App\Repository\CaracteristiqueRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CaracteristiqueRepository::class)]
class Caracteristique
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $valeur = null;

    #[ORM\ManyToOne(inversedBy: 'caracteristiques')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Vehicule $vehicule = null;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return Caracteristique
     */
    public function setId(?int $id): Caracteristique
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNom(): ?string
    {
        return $this->nom;
    }

    /**
     * @param string|null $nom
     * @return Caracteristique
     */
    public function setNom(?string $nom): Caracteristique
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getValeur(): ?string
    {
        return $this->valeur;
    }

    /**
     * @param string|null $valeur
     * @return Caracteristique
     */
    public function setValeur(?string $valeur): Caracteristique
    {
        $this->valeur = $valeur;
        return $this;
    }

    /**
     * @return Vehicule|null
     */
    public function getVehicule(): ?Vehicule
    {
        return $this->vehicule;
    }

    /**
     * @param Vehicule|null $vehicule
     * @return Caracteristique
     */
    public function setVehicule(?Vehicule $vehicule): Caracteristique
    {
        $this->vehicule = $vehicule;
        return $this;
    }


}