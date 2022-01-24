<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReservationRepository::class)
 */
class Reservation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="integer")
     */
    private $chck;

    /**
     * @ORM\OneToMany(targetEntity=ReservationDetail::class, mappedBy="ref", orphanRemoval=true, cascade={"persist", "remove"})
     */
    private $recette;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="reservation", cascade={"persist"})
     */
    private $email;

    public static function reservationBuild($date,$chck,$email)
    {
        $reservation = new Reservation();

        $reservation->setDate($date)
                    ->setChck($chck)
                    ->setEmail($email);
        
                
        return $reservation;
    }

    public function __construct()
    {
        $this->recette = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getChck(): ?int
    {
        return $this->chck;
    }

    public function setChck(int $chck): self
    {
        $this->chck = $chck;

        return $this;
    }

    /**
     * @return Collection|ReservationDetail[]
     */
    public function getRecette(): Collection
    {
        return $this->recette;
    }

    public function addRecette(ReservationDetail $recette): self
    {
        if (!$this->recette->contains($recette)) {
            $this->recette[] = $recette;
            $recette->setRef($this);
        }

        return $this;
    }

    public function removeRecette(ReservationDetail $recette): self
    {
        if ($this->recette->removeElement($recette)) {
            // set the owning side to null (unless already changed)
            if ($recette->getRef() === $this) {
                $recette->setRef(null);
            }
        }

        return $this;
    }

    public function getEmail(): ?User
    {
        return $this->email;
    }

    public function setEmail(?User $email): self
    {
        $this->email = $email;

        return $this;
    }
}
