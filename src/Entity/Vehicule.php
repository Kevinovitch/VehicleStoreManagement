<?php


namespace App\Entity;


use App\Repository\VehiculeRepository;
use App\Entity\Caracteristique;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: VehiculeRepository::class)]
class Vehicule
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $marque = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $modele = null;

    #[ORM\Column(type: 'date')]
    #[Assert\NotBlank]
    private ?\DateTimeInterface $dateImmatriculation = null;

    #[ORM\Column(length: 20)]
    #[Assert\NotBlank]
    #[Assert\Regex(pattern: '/^[A-Z]{2}-\d{3}-[A-Z]{2}$/')]
    private ?string $numeroImmatriculation = null;

    #[ORM\ManyToOne(inversedBy: 'vehicules')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Proprietaire $proprietaire = null;

    #[ORM\OneToMany(targetEntity: Caracteristique::class, mappedBy: 'vehicule', orphanRemoval: true)]
    private Collection $caracteristiques;

    public function __construct()
    {
        $this->caracteristiques = new ArrayCollection();
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
     * @return Vehicule
     */
    public function setId(?int $id): Vehicule
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getMarque(): ?string
    {
        return $this->marque;
    }

    /**
     * @param string|null $marque
     * @return Vehicule
     */
    public function setMarque(?string $marque): Vehicule
    {
        $this->marque = $marque;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getModele(): ?string
    {
        return $this->modele;
    }

    /**
     * @param string|null $modele
     * @return Vehicule
     */
    public function setModele(?string $modele): Vehicule
    {
        $this->modele = $modele;
        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getDateImmatriculation(): ?\DateTimeInterface
    {
        return $this->dateImmatriculation;
    }

    /**
     * @param \DateTimeInterface|null $dateImmatriculation
     * @return Vehicule
     */
    public function setDateImmatriculation(?\DateTimeInterface $dateImmatriculation): Vehicule
    {
        $this->dateImmatriculation = $dateImmatriculation;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNumeroImmatriculation(): ?string
    {
        return $this->numeroImmatriculation;
    }

    /**
     * @param string|null $numeroImmatriculation
     * @return Vehicule
     */
    public function setNumeroImmatriculation(?string $numeroImmatriculation): Vehicule
    {
        $this->numeroImmatriculation = $numeroImmatriculation;
        return $this;
    }

    /**
     * @return Proprietaire|null
     */
    public function getProprietaire(): ?Proprietaire
    {
        return $this->proprietaire;
    }

    /**
     * @param Proprietaire|null $proprietaire
     * @return Vehicule
     */
    public function setProprietaire(?Proprietaire $proprietaire): Vehicule
    {
        $this->proprietaire = $proprietaire;
        return $this;
    }

    /**
     * @return ArrayCollection|Collection
     */
    public function getCaracteristiques(): ArrayCollection|Collection
    {
        return $this->caracteristiques;
    }

    /**
     * @param ArrayCollection|Collection $caracteristiques
     * @return Vehicule
     */
    public function setCaracteristiques(ArrayCollection|Collection $caracteristiques): Vehicule
    {
        $this->caracteristiques = $caracteristiques;
        return $this;
    }


}