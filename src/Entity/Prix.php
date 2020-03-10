<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PrixRepository")
 */
class Prix
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="idprix")
     */
    private $idprix;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $categorie_prix;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ceremonie", inversedBy="prixes")
     * @ORM\JoinColumn(nullable=false, name="idc", referencedColumnName="idc")
     */
    private $idc;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Gagner", mappedBy="idprix")
     */
    private $gagners;

    public function __construct()
    {
        $this->gagners = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->idprix;
    }

    public function getCategoriePrix(): ?string
    {
        return $this->categorie_prix;
    }

    public function setCategoriePrix(string $categorie_prix): self
    {
        $this->categorie_prix = $categorie_prix;

        return $this;
    }

    public function getIdc(): ?Ceremonie
    {
        return $this->idc;
    }

    public function setIdc(?Ceremonie $idc): self
    {
        $this->idc = $idc;

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
            $gagner->setIdprix($this);
        }

        return $this;
    }

    public function removeGagner(Gagner $gagner): self
    {
        if ($this->gagners->contains($gagner)) {
            $this->gagners->removeElement($gagner);
            // set the owning side to null (unless already changed)
            if ($gagner->getIdprix() === $this) {
                $gagner->setIdprix(null);
            }
        }

        return $this;
    }
}
