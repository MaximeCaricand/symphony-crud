<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PersonneRepository")
 */
class Personne
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $idp;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom_p;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom_p;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Gagner", mappedBy="idp")
     * @ORM\JoinTable(name="gagner",
     	joinColumns={
			@ORM\JoinColumn(name="idp", referencedColumnName="idp", onDelete="CASCADE")		
     	},inverseJoinColumns={
     *      @ORM\JoinColumn(name="gagners",
            referencedColumnName="gagners")
     *   })
     */
    private $gagners;

    public function __construct()
    {
        $this->gagners = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->idp;
    }

    public function getNomP(): ?string
    {
        return $this->nom_p;
    }

    public function setNomP(string $nom_p): self
    {
        $this->nom_p = $nom_p;

        return $this;
    }

    public function getPrenomP(): ?string
    {
        return $this->prenom_p;
    }

    public function setPrenomP(string $prenom_p): self
    {
        $this->prenom_p = $prenom_p;

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
            $gagner->setIdp($this);
        }

        return $this;
    }

    public function removeGagner(Gagner $gagner): self
    {
        if ($this->gagners->contains($gagner)) {
            $this->gagners->removeElement($gagner);
            // set the owning side to null (unless already changed)
            if ($gagner->getIdp() === $this) {
                $gagner->setIdp(null);
            }
        }

        return $this;
    }

    public function __toString() : string
    {
        return $this->getId().' : '.$this->prenom_p.' '.strtoupper($this->nom_p);
    }
}
