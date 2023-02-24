<?php

namespace App\Entity;

use App\Repository\FlyboxRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FlyboxRepository::class)
 */
class Flybox
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $numeroTelephone;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $ssid;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $motDePasse;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getNumeroTelephone(): ?string
    {
        return $this->numeroTelephone;
    }

    public function setNumeroTelephone(?string $numeroTelephone): self
    {
        $this->numeroTelephone = $numeroTelephone;

        return $this;
    }

    public function getSsid(): ?string
    {
        return $this->ssid;
    }

    public function setSsid(?string $ssid): self
    {
        $this->ssid = $ssid;

        return $this;
    }

    public function getMotDePasse(): ?string
    {
        return $this->motDePasse;
    }

    public function setMotDePasse(?string $motDePasse): self
    {
        $this->motDePasse = $motDePasse;

        return $this;
    }
}
