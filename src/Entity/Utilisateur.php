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

    public function __construct()
    {
        $this->tests = new ArrayCollection();
        $this->i3PResultats = new ArrayCollection();
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

}
