<?php

namespace App\Entity;

use App\Repository\DomaineProRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DomaineProRepository::class)
 */
class DomainePro
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity=MetierPE::class, mappedBy="domainePro")
     */
    private $metierPEs;

    /**
     * @ORM\ManyToOne(targetEntity=GrandDomainePro::class, inversedBy="domainePros")
     * @ORM\JoinColumn(nullable=false)
     */
    private $GrandDomainePro;

    public function __construct()
    {
        $this->metierPEs = new ArrayCollection();
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
     * @return Collection|MetierPE[]
     */
    public function getMetierPEs(): Collection
    {
        return $this->metierPEs;
    }

    public function addMetierPE(MetierPE $metierPE): self
    {
        if (!$this->metierPEs->contains($metierPE)) {
            $this->metierPEs[] = $metierPE;
            $metierPE->setDomainePro($this);
        }

        return $this;
    }

    public function removeMetierPE(MetierPE $metierPE): self
    {
        if ($this->metierPEs->removeElement($metierPE)) {
            // set the owning side to null (unless already changed)
            if ($metierPE->getDomainePro() === $this) {
                $metierPE->setDomainePro(null);
            }
        }

        return $this;
    }

    public function getGrandDomainePro(): ?GrandDomainePro
    {
        return $this->GrandDomainePro;
    }

    public function setGrandDomainePro(?GrandDomainePro $GrandDomainePro): self
    {
        $this->GrandDomainePro = $GrandDomainePro;

        return $this;
    }
}
