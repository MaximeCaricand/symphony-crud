<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GagnerRepository")
 */
class Gagner
{
    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="App\Entity\Personne", inversedBy="gagners")
     * @ORM\JoinColumn(nullable=false, name="idp", referencedColumnName="idp")
     */
    private $idp;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="App\Entity\Prix", inversedBy="gagners")
     * @ORM\JoinColumn(nullable=false, name="idprix", referencedColumnName="idprix")
     */
    private $idprix;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="App\Entity\Film", inversedBy="gagners")
     * @ORM\JoinColumn(nullable=false, name="idf", referencedColumnName="idf")
     */
    private $idf;

    /**
     * @ORM\Column(type="integer")
     */
    private $annee_prix;

    public function getAnneePrix(): ?int
    {
        return $this->annee_prix;
    }

    public function setAnneePrix(int $annee_prix): self
    {
        $this->annee_prix = $annee_prix;

        return $this;
    }

    public function getIdp(): ?Personne
    {
        return $this->idp;
    }

    public function setIdp(?Personne $idp): self
    {
        $this->idp = $idp;

        return $this;
    }

    public function getIdf(): ?Film
    {
        return $this->idf;
    }

    public function setIdf(?Film $idf): self
    {
        $this->idf = $idf;

        return $this;
    }

    public function getIdprix(): ?Prix
    {
        return $this->idprix;
    }

    public function setIdprix(?Prix $idprix): self
    {
        $this->idprix = $idprix;

        return $this;
    }
    /*
    public function getToken() : int
    {
        return $this->idp.$this->idf.$this->idprix;
    }
    */
}
