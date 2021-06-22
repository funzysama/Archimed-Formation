<?php

namespace App\Entity;

use App\Repository\IrmrResultatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use phpDocumentor\Reflection\Types\This;

/**
 * @ORM\Entity(repositoryClass=IrmrResultatRepository::class)
 */
class IrmrResultat
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
    private $Realiste;

    /**
     * @ORM\Column(type="integer")
     */
    private $Investigateur;

    /**
     * @ORM\Column(type="integer")
     */
    private $Artiste;

    /**
     * @ORM\Column(type="integer")
     */
    private $Social;

    /**
     * @ORM\Column(type="integer")
     */
    private $Entrepreneur;

    /**
     * @ORM\Column(type="integer")
     */
    private $Conventionnel;

    /**
     * @ORM\Column(type="integer")
     */
    private $RealisteEtalonne;

    /**
     * @ORM\Column(type="integer")
     */
    private $InvestigateurEtalonne;

    /**
     * @ORM\Column(type="integer")
     */
    private $ArtisteEtalonne;

    /**
     * @ORM\Column(type="integer")
     */
    private $SocialEtalonne;

    /**
     * @ORM\Column(type="integer")
     */
    private $EntrepreneurEtalonne;

    /**
     * @ORM\Column(type="integer")
     */
    private $ConventionnelEtalonne;

    /**
     * @ORM\Column(type="integer")
     */
    private $RealistePourcent;

    /**
     * @ORM\Column(type="integer")
     */
    private $InvestigateurPourcent;

    /**
     * @ORM\Column(type="integer")
     */
    private $ArtistePourcent;

    /**
     * @ORM\Column(type="integer")
     */
    private $SocialPourcent;

    /**
     * @ORM\Column(type="integer")
     */
    private $EntrepreneurPourcent;

    /**
     * @ORM\Column(type="integer")
     */
    private $ConventionnelPourcent;

    /**
     * @ORM\Column(type="float")
     */
    private $Differenciation;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $DateDeCreation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Majeur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Mineur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Inferieur1;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Inferieur2;

    /**
     * @ORM\OneToOne(targetEntity=Utilisateur::class, mappedBy="ResultatRiasec", cascade={"persist", "remove"})
     */
    private $utilisateur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Consistance;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRealiste(): ?int
    {
        return $this->Realiste;
    }

    public function setRealiste(int $Realiste): self
    {
        $this->Realiste = $Realiste;

        return $this;
    }

    public function getInvestigateur(): ?int
    {
        return $this->Investigateur;
    }

    public function setInvestigateur(int $Investigateur): self
    {
        $this->Investigateur = $Investigateur;

        return $this;
    }

    public function getArtiste(): ?int
    {
        return $this->Artiste;
    }

    public function setArtiste(int $Artiste): self
    {
        $this->Artiste = $Artiste;

        return $this;
    }

    public function getSocial(): ?int
    {
        return $this->Social;
    }

    public function setSocial(int $Social): self
    {
        $this->Social = $Social;

        return $this;
    }

    public function getEntrepreneur(): ?int
    {
        return $this->Entrepreneur;
    }

    public function setEntrepreneur(int $Entrepreneur): self
    {
        $this->Entrepreneur = $Entrepreneur;

        return $this;
    }

    public function getConventionnel(): ?int
    {
        return $this->Conventionnel;
    }

    public function setConventionnel(int $Conventionnel): self
    {
        $this->Conventionnel = $Conventionnel;

        return $this;
    }

    public function getRealisteEtalonne(): ?int
    {
        return $this->RealisteEtalonne;
    }

    public function setRealisteEtalonne(int $RealisteEtalonne): self
    {
        $this->RealisteEtalonne = $RealisteEtalonne;

        return $this;
    }

    public function getInvestigateurEtalonne(): ?int
    {
        return $this->InvestigateurEtalonne;
    }

    public function setInvestigateurEtalonne(int $InvestigateurEtalonne): self
    {
        $this->InvestigateurEtalonne = $InvestigateurEtalonne;

        return $this;
    }

    public function getArtisteEtalonne(): ?int
    {
        return $this->ArtisteEtalonne;
    }

    public function setArtisteEtalonne(int $ArtisteEtalonne): self
    {
        $this->ArtisteEtalonne = $ArtisteEtalonne;

        return $this;
    }

    public function getSocialEtalonne(): ?int
    {
        return $this->SocialEtalonne;
    }

    public function setSocialEtalonne(int $SocialEtalonne): self
    {
        $this->SocialEtalonne = $SocialEtalonne;

        return $this;
    }

    public function getEntrepreneurEtalonne(): ?int
    {
        return $this->EntrepreneurEtalonne;
    }

    public function setEntrepreneurEtalonne(int $EntrepreneurEtalonne): self
    {
        $this->EntrepreneurEtalonne = $EntrepreneurEtalonne;

        return $this;
    }

    public function getConventionnelEtalonne(): ?int
    {
        return $this->ConventionnelEtalonne;
    }

    public function setConventionnelEtalonne(int $ConventionnelEtalonne): self
    {
        $this->ConventionnelEtalonne = $ConventionnelEtalonne;

        return $this;
    }

    public function getRealistePourcent(): ?int
    {
        return $this->RealistePourcent;
    }

    public function setRealistePourcent(int $RealistePourcent): self
    {
        $this->RealistePourcent = $RealistePourcent;

        return $this;
    }

    public function getInvestigateurPourcent(): ?int
    {
        return $this->InvestigateurPourcent;
    }

    public function setInvestigateurPourcent(int $InvestigateurPourcent): self
    {
        $this->InvestigateurPourcent = $InvestigateurPourcent;

        return $this;
    }

    public function getArtistePourcent(): ?int
    {
        return $this->ArtistePourcent;
    }

    public function setArtistePourcent(int $ArtistePourcent): self
    {
        $this->ArtistePourcent = $ArtistePourcent;

        return $this;
    }

    public function getSocialPourcent(): ?int
    {
        return $this->SocialPourcent;
    }

    public function setSocialPourcent(int $SocialPourcent): self
    {
        $this->SocialPourcent = $SocialPourcent;

        return $this;
    }

    public function getEntrepreneurPourcent(): ?int
    {
        return $this->EntrepreneurPourcent;
    }

    public function setEntrepreneurPourcent(int $EntrepreneurPourcent): self
    {
        $this->EntrepreneurPourcent = $EntrepreneurPourcent;

        return $this;
    }

    public function getConventionnelPourcent(): ?int
    {
        return $this->ConventionnelPourcent;
    }

    public function setConventionnelPourcent(int $ConventionnelPourcent): self
    {
        $this->ConventionnelPourcent = $ConventionnelPourcent;

        return $this;
    }

    public function getDifferenciation(): ?float
    {
        return $this->Differenciation;
    }

    public function setDifferenciation(float $Differenciation): self
    {
        $this->Differenciation = $Differenciation;

        return $this;
    }

    public function getDateDeCreation(): ?\DateTimeInterface
    {
        return $this->DateDeCreation;
    }

    public function getData(IrmrResultat $resultat): array
    {
        $data = [];
        array_push($data, $resultat->getRealiste());
        array_push($data, $resultat->getInvestigateur());
        array_push($data, $resultat->getArtiste());
        array_push($data, $resultat->getSocial());
        array_push($data, $resultat->getEntrepreneur());
        array_push($data, $resultat->getConventionnel());
        return $data;
    }

    public function getEtalData(IrmrResultat $resultat): array
    {
        $data = [];
        array_push($data, $resultat->getRealisteEtalonne());
        array_push($data, $resultat->getInvestigateurEtalonne());
        array_push($data, $resultat->getArtisteEtalonne());
        array_push($data, $resultat->getSocialEtalonne());
        array_push($data, $resultat->getEntrepreneurEtalonne());
        array_push($data, $resultat->getConventionnelEtalonne());
        return $data;
    }

    public function createLabels(): array
    {
        $data = [];
        array_push($data, "Réaliste");
        array_push($data, "Investigateur");
        array_push($data, "Artiste");
        array_push($data, "Social");
        array_push($data, "Entrepreneur");
        array_push($data, "Conventionnel");
        return $data;
    }

    public function getMajeur(): ?string
    {
        return $this->Majeur;
    }

    public function setMajeur(string $Majeur): self
    {
        $this->Majeur = $Majeur;

        return $this;
    }

    public function getMineur(): ?string
    {
        return $this->Mineur;
    }

    public function setMineur(string $Mineur): self
    {
        $this->Mineur = $Mineur;

        return $this;
    }

    public function getInferieur1(): ?string
    {
        return $this->Inferieur1;
    }

    public function setInferieur1(string $Inferieur1): self
    {
        $this->Inferieur1 = $Inferieur1;

        return $this;
    }

    public function getInferieur2(): ?string
    {
        return $this->Inferieur2;
    }

    public function setInferieur2(string $Inferieur2): self
    {
        $this->Inferieur2 = $Inferieur2;

        return $this;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): self
    {
        // unset the owning side of the relation if necessary
        if ($utilisateur === null && $this->utilisateur !== null) {
            $this->utilisateur->setResultatRiasec(null);
        }

        // set the owning side of the relation if necessary
        if ($utilisateur !== null && $utilisateur->getResultatRiasec() !== $this) {
            $utilisateur->setResultatRiasec($this);
        }

        $this->utilisateur = $utilisateur;

        return $this;
    }

    public function getConsistance(): ?string
    {
        return $this->Consistance;
    }

    public function setConsistance(?string $Consistance): self
    {
        $this->Consistance = $Consistance;

        return $this;
    }

}
