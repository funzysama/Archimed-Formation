<?php

namespace App\Entity;

use App\Repository\MetierPERepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MetierPERepository::class)
 */
class MetierPE
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelle;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $riasecMajeur;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $riasecMineur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $codeIsco;

    /**
     * @ORM\Column(type="boolean")
     */
    private $particulier;

    /**
     * @ORM\ManyToOne(targetEntity=DomainePro::class, inversedBy="metierPEs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $domainePro;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getRiasecMajeur(): ?string
    {
        return $this->riasecMajeur;
    }

    public function setRiasecMajeur(string $riasecMajeur): self
    {
        $this->riasecMajeur = $riasecMajeur;

        return $this;
    }

    public function getRiasecMineur(): ?string
    {
        return $this->riasecMineur;
    }

    public function setRiasecMineur(string $riasecMineur): self
    {
        $this->riasecMineur = $riasecMineur;

        return $this;
    }

    public function getCodeIsco(): ?string
    {
        return $this->codeIsco;
    }

    public function setCodeIsco(string $codeIsco): self
    {
        $this->codeIsco = $codeIsco;

        return $this;
    }

    public function getParticulier(): ?bool
    {
        return $this->particulier;
    }

    public function setParticulier(bool $particulier): self
    {
        $this->particulier = $particulier;

        return $this;
    }

    public function getDomainePro(): ?DomainePro
    {
        return $this->domainePro;
    }

    public function setDomainePro(?DomainePro $domainePro): self
    {
        $this->domainePro = $domainePro;

        return $this;
    }
}
