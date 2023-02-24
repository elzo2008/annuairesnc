<?php

namespace App\Entity;

use App\Repository\DepartementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DepartementRepository::class)
 */
class Departement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=Repertoire::class, mappedBy="departements")
     */
    private $repertoires;

    /**
     * @ORM\OneToMany(targetEntity=Cartouche::class, mappedBy="departement")
     */
    private $cartouches;

    public function __construct()
    {
        $this->repertoires = new ArrayCollection();
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
     * @return Collection<int, Repertoire>
     */
    public function getRepertoires(): Collection
    {
        return $this->repertoires;
    }

    public function addRepertoire(Repertoire $repertoire): self
    {
        if (!$this->repertoires->contains($repertoire)) {
            $this->repertoires[] = $repertoire;
            $repertoire->setDepartements($this);
        }

        return $this;
    }

    public function removeRepertoire(Repertoire $repertoire): self
    {
        if ($this->repertoires->removeElement($repertoire)) {
            // set the owning side to null (unless already changed)
            if ($repertoire->getDepartements() === $this) {
                $repertoire->setDepartements(null);
            }
        }

        return $this;
    }

    public function __toString(){
        return $this->getDescription();
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
            $cartouch->setDepartement($this);
        }

        return $this;
    }

    public function removeCartouch(Cartouche $cartouch): self
    {
        if ($this->cartouches->removeElement($cartouch)) {
            // set the owning side to null (unless already changed)
            if ($cartouch->getDepartement() === $this) {
                $cartouch->setDepartement(null);
            }
        }

        return $this;
    }
}
