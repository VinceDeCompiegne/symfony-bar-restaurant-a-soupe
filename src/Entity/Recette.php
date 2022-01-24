<?php

namespace App\Entity;

use App\Repository\RecetteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RecetteRepository::class)
 */
class Recette
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $nom;

    /**
     * @ORM\Column(type="integer", nullable=false, options={"unsigned":true, "default":0})
     */
    private $energy;

    /**
     * @ORM\Column(type="integer", nullable=false, options={"unsigned":true, "default":0})
     */
    private $fibers;

    /**
     * @ORM\Column(type="integer", nullable=false, options={"unsigned":true, "default":0})
     */
    private $fruit_pourcentage;

    /**
     * @ORM\Column(type="integer", nullable=false, options={"unsigned":true, "default":0})
     */
    private $proteins;

    /**
     * @ORM\Column(type="integer", nullable=false, options={"unsigned":true, "default":0})
     */
    private $satured_fats;

    /**
     * @ORM\Column(type="integer", nullable=false, options={"unsigned":true, "default":0})
     */
    private $sodium;

    /**
     * @ORM\Column(type="integer", nullable=false, options={"unsigned":true, "default":0})
     */
    private $sugar;

    public static function recetteBuild(string $nom,int $energy,int $fibers,int $fruit_pourcentage,int $proteins,int $satured_fats,int $sodium,int $sugar){

        $recette = new recette();

        $recette->setNom($nom)
                ->setEnergy($energy)
                ->setFibers($fibers)
                ->setFruitPourcentage($fruit_pourcentage)
                ->setProteins($proteins)
                ->setSaturedFats($satured_fats)
                ->setSodium($sodium)
                ->setSugar($sugar);
                
        return $recette;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getEnergy(): ?int
    {
        return $this->energy;
    }

    public function setEnergy(int $energy): self
    {
        $energy = ($energy>0)?$energy:0; 
        $this->energy = $energy;

        return $this;
    }

    public function getFibers(): ?int
    {
        return $this->fibers;
    }

    public function setFibers(int $fibers): self
    {
        $fibers = ($fibers>0)?$fibers:0;
        $this->fibers = $fibers;

        return $this;
    }

    public function getFruitPourcentage(): ?int
    {
        return $this->fruit_pourcentage;
    }

    public function setFruitPourcentage(int $fruit_pourcentage): self
    {
        $fruit_pourcentage = ($fruit_pourcentage>0)?$fruit_pourcentage:0;
        $this->fruit_pourcentage = $fruit_pourcentage;

        return $this;
    }

    public function getProteins(): ?int
    {
        return $this->proteins;
    }

    public function setProteins(int $proteins): self
    {
        $proteins = ($proteins>0)?$proteins:0;
        $this->proteins = $proteins;

        return $this;
    }

    public function getSaturedFats(): ?int
    {
        return $this->satured_fats;
    }

    public function setSaturedFats(int $satured_fats): self
    {
        $satured_fats = ($satured_fats>0)?$satured_fats:0;
        $this->satured_fats = $satured_fats;

        return $this;
    }

    public function getSodium(): ?int
    {
        return $this->sodium;
    }

    public function setSodium(int $sodium): self
    {
        $sodium = ($sodium>0)?$sodium:0;
        $this->sodium = $sodium;

        return $this;
    }

    public function getSugar(): ?int
    {
        return $this->sugar;
    }

    public function setSugar(int $sugar): self
    {
        $sugar = ($sugar>0)?$sugar:0;
        $this->sugar = $sugar;

        return $this;
    }
}
