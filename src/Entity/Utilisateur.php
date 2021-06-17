<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 * @ORM\Entity(repositoryClass=UtilisateurRepository::class)
 * @UniqueEntity(fields={"email"}, message="Il existe déja un compte avec cette adresse e-mail.")
 */
class Utilisateur implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups({"user_formated"})
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     * @Groups({"user_formated"})
     */
    private $roles = [];

    private $role = '';

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isVerified = false;

    /**
     * @ORM\Column(type="string", length=1)
     * @Groups({"user_formated"})
     */
    private $sexe;

    /**
     * @ORM\Column(type="string", length=75)
     * @Groups({"user_formated"})
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=75)
     * @Groups({"user_formated"})
     */
    private $prenom;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups({"user_formated"})
     */
    private $DateDeNaissance;

    /**
     * @ORM\Column(type="string", length=25, nullable=true)
     */
    private $Qualification;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $Situation;

    /**
     * @ORM\Column(type="string", length=25, nullable=true)
     */
    private $TrancheDage;

    /**
     * @ORM\Column(type="boolean")
     */
    private $actif;

    /**
     * @ORM\ManyToOne(targetEntity=Module::class, fetch="EAGER")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Module;

    /**
     * @ORM\ManyToOne(targetEntity=Agence::class, inversedBy="utilisateurs", fetch="EAGER")
     * @ORM\JoinColumn(nullable=false)
     */
    private $agence;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class, inversedBy="Clients", fetch="EAGER")
     */
    private $Consultant;

    /**
     * @ORM\OneToMany(targetEntity=Utilisateur::class, mappedBy="Consultant", orphanRemoval=true, fetch="EAGER")
     */
    private $Clients;

    /**
     * @ORM\ManyToMany(targetEntity=Test::class, fetch="EAGER")
     */
    private $tests;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"user_formated"})
     */
    private $authResultI3P;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"user_formated"})
     */
    private $authResultRiasec;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"user_formated"})
     */
    private $authResultPositioning;

    /**
     * @ORM\OneToOne(targetEntity=I3PResultat::class, inversedBy="utilisateur", cascade={"persist", "remove"})
     */
    private $ResultatI3P;

    /**
     * @ORM\OneToOne(targetEntity=IrmrResultat::class, inversedBy="utilisateur", cascade={"persist", "remove"})
     */
    private $ResultatRiasec;

    public function __construct()
    {
        $this->tests = new ArrayCollection();
        $this->Clients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @see UserInterface
     */
    public function getRole(): string
    {
        $roles = $this->roles;
        if(isset($roles[0])){
            return $roles[0];
        }else{
            return '';
        }
    }

    public function setRole(string $role): self
    {
        $this->role = $role;
        $this->roles[0] = $role;

        return $this;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function hasRoles(String $role){
        if(in_array($role, $this->roles)){
            return true;
        }
        return false;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function isActif(): bool
    {
        return $this->actif;
    }

    public function setIsActif(bool $actif): self
    {
        $this->actif = $actif;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * @return Collection|Test[]
     */
    public function getTests(): Collection
    {
        return $this->tests;
    }

    public function addTest(Test $test): self
    {
        if (!$this->tests->contains($test)) {
            $this->tests[] = $test;
        }

        return $this;
    }

    public function removeTest(Test $test): self
    {
        $this->tests->removeElement($test);

        return $this;
    }

    public function getActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(bool $actif): self
    {
        $this->actif = $actif;

        return $this;
    }

    public function getAgence(): ?Agence
    {
        return $this->agence;
    }

    public function setAgence(?Agence $agence): self
    {
        $this->agence = $agence;

        return $this;
    }

    public function toArray(): array
    {
        if($this->Consultant){
            $consultantName = ($this->Consultant->sexe === 'M' ? 'Mr ' : 'Mme ').$this->Consultant->getNom().' '.$this->Consultant->getPrenom();
        }else{
            if($this->hasRoles('ROLE_ADMIN')){
                $consultantName = 'Administrateur';
            }else if($this->hasRoles('ROLE_CONSULTANT')){
                $consultantName = 'Consultant';
            }
        }
        return [
            'actif' => $this->actif,
            'nom' =>$this->nom,
            'prenom' => $this->prenom,
            'email' => $this->email,
            'agence' => $this->agence->getNom(),
            'consultant'=> $consultantName,
            'id' => $this->id
        ];
    }

    public function getConsultant(): ?self
    {
        return $this->Consultant;
    }

    public function setConsultant(?self $Consultant): self
    {
        $this->Consultant = $Consultant;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getClients(): Collection
    {
        return $this->Clients;
    }

    public function addClient(self $client): self
    {
        if (!$this->Clients->contains($client)) {
            $this->Clients[] = $client;
            $client->setConsultant($this);
        }

        return $this;
    }

    public function removeClient(self $client): self
    {
        if ($this->Clients->removeElement($client)) {
            // set the owning side to null (unless already changed)
            if ($client->getConsultant() === $this) {
                $client->setConsultant(null);
            }
        }

        return $this;
    }

    public function getDateDeNaissance(): ?DateTimeInterface
    {
        return $this->DateDeNaissance;
    }

    public function setDateDeNaissance(?DateTimeInterface $DateDeNaissance): self
    {
        $this->DateDeNaissance = $DateDeNaissance;

        return $this;
    }

    public function getModule(): ?Module
    {
        return $this->Module;
    }

    public function setModule(?Module $Module): self
    {
        $this->Module = $Module;

        return $this;
    }

    public function getQualification(): ?string
    {
        return $this->Qualification;
    }

    public function setQualification(?string $Qualification): self
    {
        $this->Qualification = $Qualification;

        return $this;
    }

    public function getSituation(): ?string
    {
        return $this->Situation;
    }

    public function setSituation(?string $Situation): self
    {
        $this->Situation = $Situation;

        return $this;
    }

    public function getTrancheDage(): ?string
    {
        return $this->TrancheDage;
    }

    public function setTrancheDage(?string $TrancheDage): self
    {
        $this->TrancheDage = $TrancheDage;

        return $this;
    }

    public function getAuthResultI3P(): ?bool
    {
        return $this->authResultI3P;
    }

    public function setAuthResultI3P(bool $authResultI3P): self
    {
        $this->authResultI3P = $authResultI3P;

        return $this;
    }

    public function getAuthResultRiasec(): ?bool
    {
        return $this->authResultRiasec;
    }

    public function setAuthResultRiasec(bool $authResultRiasec): self
    {
        $this->authResultRiasec = $authResultRiasec;

        return $this;
    }

    public function getAuthResultPositioning(): ?bool
    {
        return $this->authResultPositioning;
    }

    public function setAuthResultPositioning(bool $authResultPositioning): self
    {
        $this->authResultPositioning = $authResultPositioning;

        return $this;
    }

    public function getResultatI3P(): ?I3PResultat
    {
        return $this->ResultatI3P;
    }

    public function setResultatI3P(?I3PResultat $ResultatI3P): self
    {
        $this->ResultatI3P = $ResultatI3P;

        return $this;
    }

    public function getResultatRiasec(): ?IrmrResultat
    {
        return $this->ResultatRiasec;
    }

    public function setResultatRiasec(?IrmrResultat $ResultatRiasec): self
    {
        $this->ResultatRiasec = $ResultatRiasec;

        return $this;
    }

}
