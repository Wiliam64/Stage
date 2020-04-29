<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EquipmentsRepository")
 */
class Equipments
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $init;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Projects", inversedBy="equipments")
     */
    private $project;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\States", mappedBy="Equipment")
     */
    private $states;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeEquipments", inversedBy="equipments")
     */
    private $typeEquipment;

    public function __construct()
    {
        $this->state = new ArrayCollection();
        $this->states = new ArrayCollection();
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

    public function getInit(): ?string
    {
        return $this->init;
    }

    public function setInit(string $init): self
    {
        $this->init = $init;

        return $this;
    }

    public function getProject(): ?Projects
    {
        return $this->project;
    }

    public function setProject(?Projects $project): self
    {
        $this->project = $project;

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }

    /**
     * @return Collection|States[]
     */
    public function getStates(): Collection
    {
        return $this->states;
    }

    public function addState(States $state): self
    {
        if (!$this->states->contains($state)) {
            $this->states[] = $state;
            $state->setEquipment($this);
        }

        return $this;
    }

    public function removeState(States $state): self
    {
        if ($this->states->contains($state)) {
            $this->states->removeElement($state);
            // set the owning side to null (unless already changed)
            if ($state->getEquipment() === $this) {
                $state->setEquipment(null);
            }
        }

        return $this;
    }

    public function getTypeEquipment(): ?TypeEquipments
    {
        return $this->typeEquipment;
    }

    public function setTypeEquipment(?TypeEquipments $typeEquipment): self
    {
        $this->typeEquipment = $typeEquipment;

        return $this;
    }
}
