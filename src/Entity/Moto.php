<?php

namespace App\Entity;

use App\Repository\MotoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=MotoRepository::class)
 */
class Moto
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"list_moto", "show_moto", "list_missions","show_mission"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150)
     * @Groups({"list_moto", "show_moto", "list_missions","show_mission"})
     */
    private $matricule_moto;

    /**
     * @ORM\OneToMany(targetEntity=Mission::class, mappedBy="moto")
     */
    private $missions;

    public function __construct()
    {
        $this->missions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatriculeMoto(): ?string
    {
        return $this->matricule_moto;
    }

    public function setMatriculeMoto(string $matricule_moto): self
    {
        $this->matricule_moto = $matricule_moto;

        return $this;
    }

    /**
     * @return Collection|Mission[]
     */
    public function getMissions(): Collection
    {
        return $this->missions;
    }

    public function addMission(Mission $mission): self
    {
        if (!$this->missions->contains($mission)) {
            $this->missions[] = $mission;
            $mission->setMoto($this);
        }

        return $this;
    }

    public function removeMission(Mission $mission): self
    {
        if ($this->missions->contains($mission)) {
            $this->missions->removeElement($mission);
            // set the owning side to null (unless already changed)
            if ($mission->getMoto() === $this) {
                $mission->setMoto(null);
            }
        }

        return $this;
    }
}
