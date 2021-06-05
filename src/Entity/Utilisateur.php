<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 * @ORM\Entity(repositoryClass=UtilisateurRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
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
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

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
     */
    private $sexe;

    /**
     * @ORM\Column(type="string", length=75)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=75)
     */
    private $prenom;

    /**
     * @ORM\ManyToMany(targetEntity=Test::class)
     */
    private $tests;

    /**
     * @ORM\Column(type="boolean")
     */
    private $actif;

    /**
     * @ORM\ManyToOne(targetEntity=Agence::class, inversedBy="utilisateurs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $agence;

    /**
     * @ORM\OneToMany(targetEntity=I3PResultat::class, mappedBy="Utilisateur", orphanRemoval=true)
     */
    private $i3PResultats;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class, inversedBy="Clients")
     */
    private $Consultant;

    /**
     * @ORM\OneToMany(targetEntity=Utilisateur::class, mappedBy="Consultant")
     */
    private $Clients;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $DateDeNaissance;

    /**
     * @ORM\ManyToOne(targetEntity=Module::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $Module;

    /**
     * @ORM\OneToMany(targetEntity=IrmrResultat::class, mappedBy="Utilisateur", orphanRemoval=true)
     */
    private $IrmrResultats;

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


    public function __construct()
    {
        $this->tests = new ArrayCollection();
        $this->i3PResultats = new ArrayCollection();
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
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
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
        return [
            'actif' => $this->actif,
            'nom' =>$this->nom,
            'prenom' => $this->prenom,
            'email' => $this->email,
            'agence' => $this->agence->getNom(),
            'verified' =>$this->isVerified()
        ];
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
            $i3PResultat->setUtilisateur($this);
        }

        return $this;
    }

    public function removeI3PResultat(I3PResultat $i3PResultat): self
    {
        if ($this->i3PResultats->removeElement($i3PResultat)) {
            // set the owning side to null (unless already changed)
            if ($i3PResultat->getUtilisateur() === $this) {
                $i3PResultat->setUtilisateur(null);
            }
        }

        return $this;
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

    public function getDateDeNaissance(): ?\DateTimeInterface
    {
        return $this->DateDeNaissance;
    }

    public function setDateDeNaissance(?\DateTimeInterface $DateDeNaissance): self
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

    /**
     * @return Collection|IrmrResultat[]
     */
    public function getIrmrResultats(): Collection
    {
        return $this->IrmrResultats;
    }

    public function addIrmrResultat(IrmrResultat $IrmrResultat): self
    {
        if (!$this->IrmrResultats->contains($IrmrResultat)) {
            $this->IrmrResultats[] = $IrmrResultat;
            $IrmrResultat->setUtilisateur($this);
        }

        return $this;
    }

    public function removeIrmrResultat(IrmrResultat $IrmrResultat): self
    {
        if ($this->IrmrResultats->removeElement($IrmrResultat)) {
            // set the owning side to null (unless already changed)
            if ($IrmrResultat->getUtilisateur() === $this) {
                $IrmrResultat->setUtilisateur(null);
            }
        }

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

}
