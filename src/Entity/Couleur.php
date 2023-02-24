<?php

namespace App\Entity;

use App\Repository\CouleurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CouleurRepository::class)
 */
class Couleur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=Cartouche::class, mappedBy="couleur")
     */
    private $cartouches;

    public function __construct()
    {
        $this->cartouches = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Cartouche>
     */
    public function getCartouches(): Collection
    {
        return $this->cartouches;
    }

    public function addCartouch(Cartouche $cartouch): self
    {
        if (!$this->cartouches->contains($cartouch)) {
            $this->cartouches[] = $cartouch;
            $cartouch->setCouleur($this);
        }

        return $this;
    }

    public function removeCartouch(Cartouche $cartouch): self
    {
        if ($this->cartouches->removeElement($cartouch)) {
            // set the owning side to null (unless already changed)
            if ($cartouch->getCouleur() === $this) {
                $cartouch->setCouleur(null);
            }
        }

        return $this;
    }

    public function __toString(){
        return $this->description;
    }
}
