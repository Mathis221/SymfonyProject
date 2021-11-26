<?php

namespace App\Entity;

use App\Repository\DirectorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DirectorRepository::class)
 */
class Director
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Prenom;

    /**
     * @ORM\OneToMany(targetEntity=Film::class, mappedBy="director")
     */
    private $film;

    public function __construct()
    {
        $this->film = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): self
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    /**
     * @return Collection|film[]
     */
    public function getFilm(): Collection
    {
        return $this->film;
    }

    public function addFilm(film $film): self
    {
        if (!$this->film->contains($film)) {
            $this->film[] = $film;
            $film->setDirector($this);
        }

        return $this;
    }

    public function removeFilm(film $film): self
    {
        if ($this->film->removeElement($film)) {
            // set the owning side to null (unless already changed)
            if ($film->getDirector() === $this) {
                $film->setDirector(null);
            }
        }

        return $this;
    }
}
