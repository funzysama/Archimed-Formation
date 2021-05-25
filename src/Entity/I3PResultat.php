<?php

namespace App\Entity;

use App\Repository\I3PResultatRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=I3PResultatRepository::class)
 */
class I3PResultat
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $Extraversion;

    /**
     * @ORM\Column(type="integer")
     */
    private $Introversion;

    /**
     * @ORM\Column(type="integer")
     */
    private $Sensation;

    /**
     * @ORM\Column(type="integer")
     */
    private $Intuition;

    /**
     * @ORM\Column(type="integer")
     */
    private $Thinking;

    /**
     * @ORM\Column(type="integer")
     */
    private $Feeling;

    /**
     * @ORM\Column(type="integer")
     */
    private $Rightness;

    /**
     * @ORM\Column(type="integer")
     */
    private $Opening;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $DateDeCreation;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class, inversedBy="i3PResultats")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Utilisateur;

    /**
     * @ORM\ManyToOne(targetEntity=I3pProfils::class, inversedBy="i3PResultats")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Profil;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getExtraversion(): ?int
    {
        return $this->Extraversion;
    }

    public function setExtraversion(int $Extraversion): self
    {
        $this->Extraversion = $Extraversion;

        return $this;
    }

    public function getIntroversion(): ?int
    {
        return $this->Introversion;
    }

    public function setIntroversion(int $Introversion): self
    {
        $this->Introversion = $Introversion;

        return $this;
    }

    public function getSensation(): ?int
    {
        return $this->Sensation;
    }

    public function setSensation(int $Sensation): self
    {
        $this->Sensation = $Sensation;

        return $this;
    }

    public function getIntuition(): ?int
    {
        return $this->Intuition;
    }

    public function setIntuition(int $Intuition): self
    {
        $this->Intuition = $Intuition;

        return $this;
    }

    public function getThinking(): ?int
    {
        return $this->Thinking;
    }

    public function setThinking(int $Thinking): self
    {
        $this->Thinking = $Thinking;

        return $this;
    }

    public function getFeeling(): ?int
    {
        return $this->Feeling;
    }

    public function setFeeling(int $Feeling): self
    {
        $this->Feeling = $Feeling;

        return $this;
    }

    public function getRightness(): ?int
    {
        return $this->Rightness;
    }

    public function setRightness(int $Rightness): self
    {
        $this->Rightness = $Rightness;

        return $this;
    }

    public function getOpening(): ?int
    {
        return $this->Opening;
    }

    public function setOpening(int $Opening): self
    {
        $this->Opening = $Opening;

        return $this;
    }

    public function getDateDeCreation(): ?\DateTimeInterface
    {
        return $this->DateDeCreation;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->Utilisateur;
    }

    public function setUtilisateur(?Utilisateur $Utilisateur): self
    {
        $this->Utilisateur = $Utilisateur;

        return $this;
    }

    public function getProfil(): ?I3pProfils
    {
        return $this->Profil;
    }

    public function setProfil(?I3pProfils $Profil): self
    {
        $this->Profil = $Profil;

        return $this;
    }

}
