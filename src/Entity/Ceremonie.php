<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CeremonieRepository")
 */
class Ceremonie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue()
     * @ORM\Column(name="idc", type="integer")
     */
    private $idc;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom_ceremonie;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Prix", mappedBy="idc")
     */
    private $prixes;

    public function __construct()
    {
        $this->prixes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->idc;
    }

    public function getNomCeremonie(): ?string
    {
        return $this->nom_ceremonie;
    }

    public function setNomCeremonie(string $nom_ceremonie): self
    {
        $this->nom_ceremonie = $nom_ceremonie;

        return $this;
    }

    /**
     * @return Collection|Prix[]
     */
    public function getPrixes(): Collection
    {
        return $this->prixes;
    }

    public function addPrix(Prix $prix): self
    {
        if (!$this->prixes->contains($prix)) {
            $this->prixes[] = $prix;
            $prix->setIdc($this);
        }

        return $this;
    }

    public function removePrix(Prix $prix): self
    {
        if ($this->prixes->contains($prix)) {
            $this->prixes->removeElement($prix);
            // set the owning side to null (unless already changed)
            if ($prix->getIdc() === $this) {
                $prix->setIdc(null);
            }
        }

        return $this;
    }
}
