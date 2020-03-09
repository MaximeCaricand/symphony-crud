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
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $annee_prix;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Personne", inversedBy="gagners")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idp;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Film", inversedBy="gagners")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idf;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Prix", inversedBy="gagners")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idprix;

    public function getId(): ?int
    {
        return $this->id;
    }

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
}
