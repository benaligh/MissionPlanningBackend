<?php

namespace App\Entity;

use App\Repository\AdressRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=AdressRepository::class)
 */
class Adress
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"list_adress","show_adress","list_missions","show_mission"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"list_adress","show_adress","list_missions","show_mission"})
     */
    private $location_adress;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLocationAdress(): ?string
    {
        return $this->location_adress;
    }

    public function setLocationAdress(string $location_adress): self
    {
        $this->location_adress = $location_adress;

        return $this;
    }
}
