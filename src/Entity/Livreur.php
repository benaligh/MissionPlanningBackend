<?php

namespace App\Entity;

use App\Repository\LivreurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ORM\Entity(repositoryClass=LivreurRepository::class)
 */
class Livreur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"list_livreur", "show_livreur", "list_missions","show_mission"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"list_livreur", "show_livreur", "list_missions","show_mission"})
     */
    private $username_livreur;

    /**
     * @ORM\OneToMany(targetEntity=Mission::class, mappedBy="livreur")
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

    public function getUsernameLivreur(): ?string
    {
        return $this->username_livreur;
    }

    public function setUsernameLivreur(string $username_livreur): self
    {
        $this->username_livreur = $username_livreur;

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
            $mission->setLivreur($this);
        }

        return $this;
    }

    public function removeMission(Mission $mission): self
    {
        if ($this->missions->contains($mission)) {
            $this->missions->removeElement($mission);
            // set the owning side to null (unless already changed)
            if ($mission->getLivreur() === $this) {
                $mission->setLivreur(null);
            }
        }

        return $this;
    }
}
