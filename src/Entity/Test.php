<?php

namespace App\Entity;

use App\Repository\TestRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=TestRepository::class)
 */
class Test
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=75)
     */
    private $Nom;

    /**
     * @ORM\OneToMany(targetEntity=Question::class, mappedBy="test", orphanRemoval=true)
     */
    private $questions;

    /**
     * @Gedmo\Slug(fields={"Nom"})
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\OneToOne(targetEntity=Presentation::class, mappedBy="test", cascade={"persist", "remove"})
     */
    private $presentation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomVisuel;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    /**
     * @return Collection|Question[]
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Question $question): self
    {
        if (!$this->questions->contains($question)) {
            $this->questions[] = $question;
            $question->setTest($this);
        }

        return $this;
    }

    public function removeQuestion(Question $question): self
    {
        if ($this->questions->removeElement($question)) {
            // set the owning side to null (unless already changed)
            if ($question->getTest() === $this) {
                $question->setTest(null);
            }
        }

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function getPresentation(): ?Presentation
    {
        return $this->presentation;
    }

    public function setPresentation(?Presentation $presentation): self
    {
        // unset the owning side of the relation if necessary
        if ($presentation === null && $this->presentation !== null) {
            $this->presentation->setTest(null);
        }

        // set the owning side of the relation if necessary
        if ($presentation !== null && $presentation->getTest() !== $this) {
            $presentation->setTest($this);
        }

        $this->presentation = $presentation;

        return $this;
    }

    public function getNomVisuel(): ?string
    {
        return $this->nomVisuel;
    }

    public function setNomVisuel(string $nomVisuel): self
    {
        $this->nomVisuel = $nomVisuel;

        return $this;
    }
}
