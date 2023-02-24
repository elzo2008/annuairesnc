<?php

namespace App\Entity;

use App\Repository\DesktopRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DesktopRepository::class)
 */
class Desktop
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nomOrdinateur;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $proprietaire;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $ip;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $localisation;

    /**
     * @ORM\Column(type="string", length=11, nullable=true)
     */
    private $anydesk;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomOrdinateur(): ?string
    {
        return $this->nomOrdinateur;
    }

    public function setNomOrdinateur(string $nomOrdinateur): self
    {
        $this->nomOrdinateur = $nomOrdinateur;

        return $this;
    }

    public function getProprietaire(): ?string
    {
        return $this->proprietaire;
    }

    public function setProprietaire(?string $proprietaire): self
    {
        $this->proprietaire = $proprietaire;

        return $this;
    }

    public function getIp(): ?string
    {
        return $this->ip;
    }

    public function setIp(?string $ip): self
    {
        $this->ip = $ip;

        return $this;
    }

    public function getLocalisation(): ?string
    {
        return $this->localisation;
    }

    public function setLocalisation(string $localisation): self
    {
        $this->localisation = $localisation;

        return $this;
    }

    public function getAnydesk(): ?string
    {
        return $this->anydesk;
    }

    public function setAnydesk(?string $anydesk): self
    {
        $this->anydesk = $anydesk;

        return $this;
    }
}
