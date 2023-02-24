<?php

namespace App\Entity;

use App\Repository\TacheRepository;
use Doctrine\ORM\Mapping as ORM;
//Classe pour upload les fichiers
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @ORM\Entity(repositoryClass=TacheRepository::class)
 * @Vich\Uploadable
 */
class Tache
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string|null 
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $filename;

    /**
     * @var File|null 
     * @Vich\UploadableField(mapping="taches", fileNameProperty="filename")
     * 
     */
    private $imageFile;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $numDa;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $numBc;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $numFac;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateExecution;

    /**
     * @ORM\ManyToOne(targetEntity=Employe::class, inversedBy="taches")
     */
    private $employe;

    /**
     * @ORM\ManyToOne(targetEntity=Statut::class, inversedBy="taches")
     */
    private $statut;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $commentaire;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
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

    public function getNumDa(): ?string
    {
        return $this->numDa;
    }

    public function setNumDa(?string $numDa): self
    {
        $this->numDa = $numDa;

        return $this;
    }

    public function getNumBc(): ?string
    {
        return $this->numBc;
    }

    public function setNumBc(?string $numBc): self
    {
        $this->numBc = $numBc;

        return $this;
    }

    public function getNumFac(): ?string
    {
        return $this->numFac;
    }

    public function setNumFac(?string $numFac): self
    {
        $this->numFac = $numFac;

        return $this;
    }

    public function getDateExecution(): ?\DateTimeInterface
    {
        return $this->dateExecution;
    }

    public function setDateExecution(?\DateTimeInterface $dateExecution): self
    {
        $this->dateExecution = $dateExecution;

        return $this;
    }

    public function getEmploye(): ?Employe
    {
        return $this->employe;
    }

    public function setEmploye(?Employe $employe): self
    {
        $this->employe = $employe;

        return $this;
    }

    public function getStatut(): ?Statut
    {
        return $this->statut;
    }

    public function setStatut(?Statut $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getFileName(): ?string
    {
        return $this->filename;
    }

    /**
     * @param null|string $fileName
     * @return Tache
     */ 
    public function setFilename(?string $filename): Tache
    {
        $this->filename = $filename;
        return $this;
    }

    /**
     * @return null|File
     */
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    /**
     * @param null|File $imageFile
     * @return Tache
     */

    public function setImageFile(?File $imageFile): Tache
    {
        $this->imageFile = $imageFile;
        return $this;
    }

}
