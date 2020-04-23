<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StatesRepository")
 */
class States
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
     * @ORM\OneToMany(targetEntity="App\Entity\Equipments", mappedBy="objects")
     */
    private $object;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeEquipments", inversedBy="states")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typeEquipments;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Actions", mappedBy="states")
     */
    private $actions;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Attributes", mappedBy="states")
     */
    private $attributes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Conditions", mappedBy="states")
     */
    private $conditions;

    public function __construct()
    {
        $this->actions = new ArrayCollection();
        $this->attributes = new ArrayCollection();
        $this->conditions = new ArrayCollection();
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

    public function getObject(): ?Equipments
    {
        return $this->object;
    }

    public function setObject(?Equipments $object): self
    {
        $this->object = $object;

        return $this;
    }

    public function getTypeEquipments(): ?TypeEquipments
    {
        return $this->typeEquipments;
    }

    public function setTypeEquipments(?TypeEquipments $typeEquipments): self
    {
        $this->typeEquipments = $typeEquipments;

        return $this;
    }

    /**
     * @return Collection|Actions[]
     */
    public function getActions(): Collection
    {
        return $this->actions;
    }

    public function addAction(Actions $action): self
    {
        if (!$this->actions->contains($action)) {
            $this->actions[] = $action;
            $action->setStates($this);
        }

        return $this;
    }

    public function removeAction(Actions $action): self
    {
        if ($this->actions->contains($action)) {
            $this->actions->removeElement($action);
            // set the owning side to null (unless already changed)
            if ($action->getStates() === $this) {
                $action->setStates(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Attributes[]
     */
    public function getAttributes(): Collection
    {
        return $this->attributes;
    }

    public function addAttribute(Attributes $attribute): self
    {
        if (!$this->attributes->contains($attribute)) {
            $this->attributes[] = $attribute;
            $attribute->setStates($this);
        }

        return $this;
    }

    public function removeAttribute(Attributes $attribute): self
    {
        if ($this->attributes->contains($attribute)) {
            $this->attributes->removeElement($attribute);
            // set the owning side to null (unless already changed)
            if ($attribute->getStates() === $this) {
                $attribute->setStates(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Conditions[]
     */
    public function getConditions(): Collection
    {
        return $this->conditions;
    }

    public function addCondition(Conditions $condition): self
    {
        if (!$this->conditions->contains($condition)) {
            $this->conditions[] = $condition;
            $condition->setStates($this);
        }

        return $this;
    }

    public function removeCondition(Conditions $condition): self
    {
        if ($this->conditions->contains($condition)) {
            $this->conditions->removeElement($condition);
            // set the owning side to null (unless already changed)
            if ($condition->getStates() === $this) {
                $condition->setStates(null);
            }
        }

        return $this;
    }
}
