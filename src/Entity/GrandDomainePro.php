<?php

namespace App\Entity;

use App\Repository\GrandDomaineProRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GrandDomaineProRepository::class)
 */
class GrandDomainePro
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity=DomainePro::class, mappedBy="GrandDomainePro")
     */
    private $domainePros;

    public function __construct()
    {
        $this->domainePros = new ArrayCollection();
    }

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

    /**
     * @return Collection|DomainePro[]
     */
    public function getDomainePros(): Collection
    {
        return $this->domainePros;
    }

    public function addDomainePro(DomainePro $domainePro): self
    {
        if (!$this->domainePros->contains($domainePro)) {
            $this->domainePros[] = $domainePro;
            $domainePro->setGrandDomainePro($this);
        }

        return $this;
    }

    public function removeDomainePro(DomainePro $domainePro): self
    {
        if ($this->domainePros->removeElement($domainePro)) {
            // set the owning side to null (unless already changed)
            if ($domainePro->getGrandDomainePro() === $this) {
                $domainePro->setGrandDomainePro(null);
            }
        }

        return $this;
    }
}
