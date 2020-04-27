<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProjectsRepository")
 */
class Projects
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Customers", inversedBy="projects")
     */
    private $customers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Equipments", mappedBy="project")
     */
    private $equipments;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UsersProjects", mappedBy="projects")
     */
    private $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->equipments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCustomers(): ?Customers
    {
        return $this->customers;
    }

    public function setCustomers(?Customers $customers): self
    {
        $this->customers = $customers;

        return $this;
    }

    /**
     * @return Collection|Equipments[]
     */
    public function getEquipments(): Collection
    {
        return $this->equipments;
    }

    public function addEquipment(Equipments $equipment): self
    {
        if (!$this->equipments->contains($equipment)) {
            $this->equipments[] = $equipment;
            $equipment->setProject($this);
        }

        return $this;
    }

    public function removeEquipment(Equipments $equipment): self
    {
        if ($this->equipments->contains($equipment)) {
            $this->equipments->removeElement($equipment);
            // set the owning side to null (unless already changed)
            if ($equipment->getProject() === $this) {
                $equipment->setProject(null);
            }
        }

        return $this;
    }
    
    public function __toString(): string
    {
        return $this->name;
    }

    /**
     * @return Collection|UsersProjects[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(UsersProjects $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setProjects($this);
        }

        return $this;
    }

    public function removeUser(UsersProjects $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getProjects() === $this) {
                $user->setProjects(null);
            }
        }

        return $this;
    }
}
