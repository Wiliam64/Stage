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
     * @ORM\ManyToOne(targetEntity="App\Entity\States", inversedBy="object")
     */
    private $state;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Projects", inversedBy="equipments")
     */
    private $project;

    public function __construct()
    {
        $this->state = new ArrayCollection();
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

    /**
     * @return Collection|States[]
     */
    public function getstate(): Collection
    {
        return $this->state;
    }

    public function addObject(States $object): self
    {
        if (!$this->state->contains($object)) {
            $this->state[] = $object;
            $object->setObject($this);
        }

        return $this;
    }

    public function removeObject(States $object): self
    {
        if ($this->state->contains($object)) {
            $this->state->removeElement($object);
            // set the owning side to null (unless already changed)
            if ($object->getObject() === $this) {
                $object->setObject(null);
            }
        }

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
}
