<?php

namespace App\Entity;

use App\Repository\FournisseurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FournisseurRepository::class)
 */
class Fournisseur
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
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=Materiel::class, mappedBy="fournisseur")
     */
    private $materiels;

    /**
     * @ORM\OneToMany(targetEntity=Cartouche::class, mappedBy="fournisseur")
     */
    private $cartouches;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $coeurMetier;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $telephone;

    public function __construct()
    {
        $this->materiels = new ArrayCollection();
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
     * @return Collection<int, Materiel>
     */
    public function getMateriels(): Collection
    {
        return $this->materiels;
    }

    public function addMateriel(Materiel $materiel): self
    {
        if (!$this->materiels->contains($materiel)) {
            $this->materiels[] = $materiel;
            $materiel->setFournisseur($this);
        }

        return $this;
    }

    public function removeMateriel(Materiel $materiel): self
    {
        if ($this->materiels->removeElement($materiel)) {
            // set the owning side to null (unless already changed)
            if ($materiel->getFournisseur() === $this) {
                $materiel->setFournisseur(null);
            }
        }

        return $this;
    }

    public function __toString(){
        return $this->description;
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
            $cartouch->setFournisseur($this);
        }

        return $this;
    }

    public function removeCartouch(Cartouche $cartouch): self
    {
        if ($this->cartouches->removeElement($cartouch)) {
            // set the owning side to null (unless already changed)
            if ($cartouch->getFournisseur() === $this) {
                $cartouch->setFournisseur(null);
            }
        }

        return $this;
    }

    public function getCoeurMetier(): ?string
    {
        return $this->coeurMetier;
    }

    public function setCoeurMetier(?string $coeurMetier): self
    {
        $this->coeurMetier = $coeurMetier;

        return $this;
    }

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(?int $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }
}
