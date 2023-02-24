<?php

namespace App\Entity;

use App\Repository\CartoucheRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CartoucheRepository::class)
 */
class Cartouche
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $nomPersonne;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $referenceCartouche;


    /**
     * @ORM\Column(type="integer")
     */
    private $qte;

    /**
     * @ORM\ManyToOne(targetEntity=Departement::class, inversedBy="cartouches")
     */
    private $departement;

    /**
     * @ORM\ManyToOne(targetEntity=Couleur::class, inversedBy="cartouches")
     */
    private $couleur;

    /**
     * @ORM\ManyToOne(targetEntity=Fournisseur::class, inversedBy="cartouches")
     */
    private $fournisseur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getNomPersonne(): ?string
    {
        return $this->nomPersonne;
    }

    public function setNomPersonne(?string $nomPersonne): self
    {
        $this->nomPersonne = $nomPersonne;

        return $this;
    }

    public function getReferenceCartouche(): ?string
    {
        return $this->referenceCartouche;
    }

    public function setReferenceCartouche(string $referenceCartouche): self
    {
        $this->referenceCartouche = $referenceCartouche;

        return $this;
    }


    public function getQte(): ?int
    {
        return $this->qte;
    }

    public function setQte(int $qte): self
    {
        $this->qte = $qte;

        return $this;
    }

    public function getDepartement(): ?Departement
    {
        return $this->departement;
    }

    public function setDepartement(?Departement $departement): self
    {
        $this->departement = $departement;

        return $this;
    }

    public function getCouleur(): ?Couleur
    {
        return $this->couleur;
    }

    public function setCouleur(?Couleur $couleur): self
    {
        $this->couleur = $couleur;

        return $this;
    }

    public function getFournisseur(): ?Fournisseur
    {
        return $this->fournisseur;
    }

    public function setFournisseur(?Fournisseur $fournisseur): self
    {
        $this->fournisseur = $fournisseur;

        return $this;
    }
}
