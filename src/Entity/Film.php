<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FilmRepository")
 */
class Film
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom_f;

    /**
     * @ORM\Column(type="date")
     */
    private $date_sortie;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Gagner", mappedBy="idf")
     */
    private $gagners;

    public function __construct()
    {
        $this->gagners = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomF(): ?string
    {
        return $this->nom_f;
    }

    public function setNomF(string $nom_f): self
    {
        $this->nom_f = $nom_f;

        return $this;
    }

    public function getDateSortie(): ?\DateTimeInterface
    {
        return $this->date_sortie;
    }

    public function setDateSortie(\DateTimeInterface $date_sortie): self
    {
        $this->date_sortie = $date_sortie;

        return $this;
    }

    /**
     * @return Collection|Gagner[]
     */
    public function getGagners(): Collection
    {
        return $this->gagners;
    }

    public function addGagner(Gagner $gagner): self
    {
        if (!$this->gagners->contains($gagner)) {
            $this->gagners[] = $gagner;
            $gagner->setIdf($this);
        }

        return $this;
    }

    public function removeGagner(Gagner $gagner): self
    {
        if ($this->gagners->contains($gagner)) {
            $this->gagners->removeElement($gagner);
            // set the owning side to null (unless already changed)
            if ($gagner->getIdf() === $this) {
                $gagner->setIdf(null);
            }
        }

        return $this;
    }
}
