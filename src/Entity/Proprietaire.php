<?php

namespace App\Entity;


use App\Repository\ProprietaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProprietaireRepository::class)]
class Proprietaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(min: 2, max: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(min: 2, max: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Email]
    private ?string $email = null;

    #[ORM\OneToMany(targetEntity: Vehicule::class, mappedBy: 'proprietaire', orphanRemoval: true)]
    private Collection $vehicules;

    public function __construct()
    {
        $this->vehicules = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return Proprietaire
     */
    public function setId(?int $id): Proprietaire
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
     * @return Proprietaire
     */
    public function setNom(?string $nom): Proprietaire
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    /**
     * @param string|null $prenom
     * @return Proprietaire
     */
    public function setPrenom(?string $prenom): Proprietaire
    {
        $this->prenom = $prenom;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     * @return Proprietaire
     */
    public function setEmail(?string $email): Proprietaire
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return ArrayCollection|Collection
     */
    public function getVehicules(): ArrayCollection|Collection
    {
        return $this->vehicules;
    }

    /**
     * @param ArrayCollection|Collection $vehicules
     * @return Proprietaire
     */
    public function setVehicules(ArrayCollection|Collection $vehicules): Proprietaire
    {
        $this->vehicules = $vehicules;
        return $this;
    }


}