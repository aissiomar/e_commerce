<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    private ?string $lastname = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(type: Types::ARRAY)]
    private array $roles = [];

    /**
     * @var Collection<int, Cart>
     */
    #[ORM\OneToMany(targetEntity: Cart::class, mappedBy: 'user')]
    private Collection $purchaseDate;

    public function __construct()
    {
        $this->purchaseDate = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @return Collection<int, Cart>
     */
    public function getPurchaseDate(): Collection
    {
        return $this->purchaseDate;
    }

    public function addPurchaseDate(Cart $purchaseDate): static
    {
        if (!$this->purchaseDate->contains($purchaseDate)) {
            $this->purchaseDate->add($purchaseDate);
            $purchaseDate->setUser($this);
        }

        return $this;
    }

    public function removePurchaseDate(Cart $purchaseDate): static
    {
        if ($this->purchaseDate->removeElement($purchaseDate)) {
            // set the owning side to null (unless already changed)
            if ($purchaseDate->getUser() === $this) {
                $purchaseDate->setUser(null);
            }
        }

        return $this;
    }
}
