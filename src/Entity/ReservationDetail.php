<?php

namespace App\Entity;

use App\Repository\ReservationDetailRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReservationDetailRepository::class)
 */
class ReservationDetail
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Reservation::class, inversedBy="reservation", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $ref;

    /**
     * @ORM\OneToOne(targetEntity=Recette::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false,name="recette_id", referencedColumnName="id")
     */
    private $recette;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantite;


    /**
     * @ORM\ManyToOne(targetEntity=Description::class, cascade={"persist", "remove"})
     */
    private $image;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRef(): ?Reservation
    {
        return $this->ref;
    }

    public function setRef(?Reservation $ref): self
    {
        $this->ref = $ref;

        return $this;
    }

    public function getRecette(): ? Recette
    {
        return $this->recette;
    }

    public function setRecette(Recette $recette): self
    {
        $this->recette = $recette;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

  

    public function getImage(): ?Description
    {
        return $this->image;
    }

    public function setImage(?Description $image): self
    {
        $this->image = $image;

        return $this;
    }
}
