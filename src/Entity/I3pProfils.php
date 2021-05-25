<?php

namespace App\Entity;

use App\Repository\I3pProfilsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=I3pProfilsRepository::class)
 */
class I3pProfils
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=4)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=2)
     */
    private $Famille;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $Energie;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $EnergieLetter;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $Information;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $InformationLetter;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $Descision;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $DescisionLetter;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $Organisation;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $OrganisationLetter;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $Dominant;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $Auxiliaire;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $Tertiaire;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $Infeur;

    /**
     * @ORM\Column(type="text")
     */
    private $ProfilPerso;

    /**
     * @ORM\Column(type="text")
     */
    private $ProfilPro;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Valeurs;

    /**
     * @ORM\OneToMany(targetEntity=I3PResultat::class, mappedBy="Profil")
     */
    private $i3PResultats;

    public function __construct()
    {
        $this->i3PResultats = new ArrayCollection();
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

    public function getFamille(): ?string
    {
        return $this->Famille;
    }

    public function setFamille(string $Famille): self
    {
        $this->Famille = $Famille;

        return $this;
    }

    public function getEnergie(): ?string
    {
        return $this->Energie;
    }

    public function setEnergie(string $Energie): self
    {
        $this->Energie = $Energie;

        return $this;
    }

    public function getEnergieLetter(): ?string
    {
        return $this->EnergieLetter;
    }

    public function setEnergieLetter(string $EnergieLetter): self
    {
        $this->EnergieLetter = $EnergieLetter;

        return $this;
    }

    public function getInformation(): ?string
    {
        return $this->Information;
    }

    public function setInformation(string $Information): self
    {
        $this->Information = $Information;

        return $this;
    }

    public function getInformationLetter(): ?string
    {
        return $this->InformationLetter;
    }

    public function setInformationLetter(string $InformationLetter): self
    {
        $this->InformationLetter = $InformationLetter;

        return $this;
    }

    public function getDescision(): ?string
    {
        return $this->Descision;
    }

    public function setDescision(string $Descision): self
    {
        $this->Descision = $Descision;

        return $this;
    }

    public function getDescisionLetter(): ?string
    {
        return $this->DescisionLetter;
    }

    public function setDescisionLetter(string $DescisionLetter): self
    {
        $this->DescisionLetter = $DescisionLetter;

        return $this;
    }

    public function getOrganisation(): ?string
    {
        return $this->Organisation;
    }

    public function setOrganisation(string $Organisation): self
    {
        $this->Organisation = $Organisation;

        return $this;
    }

    public function getOrganisationLetter(): ?string
    {
        return $this->OrganisationLetter;
    }

    public function setOrganisationLetter(string $OrganisationLetter): self
    {
        $this->OrganisationLetter = $OrganisationLetter;

        return $this;
    }

    public function getDominant(): ?string
    {
        return $this->Dominant;
    }

    public function setDominant(string $Dominant): self
    {
        $this->Dominant = $Dominant;

        return $this;
    }

    public function getAuxiliaire(): ?string
    {
        return $this->Auxiliaire;
    }

    public function setAuxiliaire(string $Auxiliaire): self
    {
        $this->Auxiliaire = $Auxiliaire;

        return $this;
    }

    public function getTertiaire(): ?string
    {
        return $this->Tertiaire;
    }

    public function setTertiaire(string $Tertiaire): self
    {
        $this->Tertiaire = $Tertiaire;

        return $this;
    }

    public function getInfeur(): ?string
    {
        return $this->Infeur;
    }

    public function setInfeur(string $Infeur): self
    {
        $this->Infeur = $Infeur;

        return $this;
    }

    public function getProfilPerso(): ?string
    {
        return $this->ProfilPerso;
    }

    public function setProfilPerso(string $ProfilPerso): self
    {
        $this->ProfilPerso = $ProfilPerso;

        return $this;
    }

    public function getProfilPro(): ?string
    {
        return $this->ProfilPro;
    }

    public function setProfilPro(string $ProfilPro): self
    {
        $this->ProfilPro = $ProfilPro;

        return $this;
    }

    public function getValeurs(): ?string
    {
        return $this->Valeurs;
    }

    public function setValeurs(string $Valeurs): self
    {
        $this->Valeurs = $Valeurs;

        return $this;
    }

    /**
     * @return Collection|I3PResultat[]
     */
    public function getI3PResultats(): Collection
    {
        return $this->i3PResultats;
    }

    public function addI3PResultat(I3PResultat $i3PResultat): self
    {
        if (!$this->i3PResultats->contains($i3PResultat)) {
            $this->i3PResultats[] = $i3PResultat;
            $i3PResultat->setProfil($this);
        }

        return $this;
    }

    public function removeI3PResultat(I3PResultat $i3PResultat): self
    {
        if ($this->i3PResultats->removeElement($i3PResultat)) {
            // set the owning side to null (unless already changed)
            if ($i3PResultat->getProfil() === $this) {
                $i3PResultat->setProfil(null);
            }
        }

        return $this;
    }
}
