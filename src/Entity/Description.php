<?php

namespace App\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\RecetteRepository;
use App\Repository\DescriptionRepository;

/**
 * @ORM\Entity(repositoryClass=DescriptionRepository::class)
 */
class Description
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Recette::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false,name="nom_id", referencedColumnName="id")
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=1024, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $image;

    /**
     * @ORM\Column(type="integer")
     */
    private $active;

    /**
     * @ORM\Column(type="integer")
     */
    private $aime;

    /**
     * @ORM\OneToMany(targetEntity=ReservationDetail::class, mappedBy="description")
     */
    private $reservationDetails;

    public static function descriptionbuild($nom, $description, $prix, $image, $active, $aime)
    {

        $desc = new Description();
        $desc->setNom($nom);
        $desc->setDescription($description);
        $desc->setPrix($prix);
        $desc->setImage($image);
        $desc->setActive($active);
        $desc->setAime($aime);

        return $desc;
    }

    public function __construct()
    {
        $this->reservationDetails = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ? Recette
    {
        return $this->nom;
    }

    public function setNom(Recette $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getActive(): ?int
    {
        return $this->active;
    }

    public function setActive(int $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getAime(): ?int
    {
        return $this->aime;
    }

    public function setAime(int $aime): self
    {
        $this->aime = $aime;

        return $this;
    }

    /**
     * @return Collection|ReservationDetail[]
     */
    public function getReservationDetails(): Collection
    {
        return $this->reservationDetails;
    }

    // public function addReservationDetail(ReservationDetail $reservationDetail): self
    // {
    //     if (!$this->reservationDetails->contains($reservationDetail)) {
    //         $this->reservationDetails[] = $reservationDetail;
    //         $reservationDetail->setDescription($this);
    //     }

    //     return $this;
    // }

    // public function removeReservationDetail(ReservationDetail $reservationDetail): self
    // {
    //     if ($this->reservationDetails->removeElement($reservationDetail)) {
    //         // set the owning side to null (unless already changed)
    //         if ($reservationDetail->getDescription() === $this) {
    //             $reservationDetail->setDescription(null);
    //         }
    //     }

    //     return $this;
    // }
}
