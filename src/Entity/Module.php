<?php

namespace App\Entity;

use App\Repository\ModuleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ModuleRepository::class)
 */
class Module
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
    private $nom;

    /**
     * @ORM\ManyToMany(targetEntity=Test::class)
     */
    private $testsInscrits;

    public function __construct()
    {
        $this->testsInscrits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection|Test[]
     */
    public function getTestsInscrits(): Collection
    {
        return $this->testsInscrits;
    }

    public function addTestsInscrit(Test $testsInscrit): self
    {
        if (!$this->testsInscrits->contains($testsInscrit)) {
            $this->testsInscrits[] = $testsInscrit;
        }

        return $this;
    }

    public function removeTestsInscrit(Test $testsInscrit): self
    {
        $this->testsInscrits->removeElement($testsInscrit);

        return $this;
    }
}
