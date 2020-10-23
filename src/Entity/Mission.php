<?php

namespace App\Entity;

use App\Repository\MissionRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=MissionRepository::class)
 */
class Mission
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"list_missions","show_mission"})
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     * @Groups({"list_missions","show_mission"})
     */
    private $mission_date;

    /**
     * @ORM\ManyToOne(targetEntity=Livreur::class, inversedBy="missions", cascade={"persist", "remove"})
     * @Groups({"list_missions","show_mission"})
     */
    private $livreur;

    /**
     * @ORM\ManyToOne(targetEntity=Moto::class, inversedBy="missions", cascade={"persist", "remove"})
     * @Groups({"list_missions","show_mission"})
     */
    private $moto;

    /**
     * @ORM\OneToOne(targetEntity=Adress::class, cascade={"persist", "remove"})
     * @Groups({"list_missions","show_mission"})
     */
    private $adress;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMissionDate(): ?\DateTimeInterface
    {
        return $this->mission_date;
    }

    public function setMissionDate(\DateTimeInterface $mission_date): self
    {
        $this->mission_date = $mission_date;

        return $this;
    }

    public function getLivreur(): ?Livreur
    {
        return $this->livreur;
    }

    public function setLivreur(?Livreur $livreur): self
    {
        $this->livreur = $livreur;

        return $this;
    }

    public function getMoto(): ?Moto
    {
        return $this->moto;
    }

    public function setMoto(?Moto $moto): self
    {
        $this->moto = $moto;

        return $this;
    }

    public function getAdress(): ?Adress
    {
        return $this->adress;
    }

    public function setAdress(?Adress $adress): self
    {
        $this->adress = $adress;

        return $this;
    }
}
