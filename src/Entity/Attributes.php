<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AttributesRepository")
 */
class Attributes
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups("get:read")
     */
    private $key_attribute;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups("get:read")
     */
    private $value;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\States", inversedBy="attributes")
     */
    private $states;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getKeyAttribute(): ?string
    {
        return $this->key_attribute;
    }

    public function setKeyAttribute(string $key_attribute): self
    {
        $this->key_attribute = $key_attribute;

        return $this;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getStates(): ?States
    {
        return $this->states;
    }

    public function setStates(?States $states): self
    {
        $this->states = $states;

        return $this;
    }

    public function __toString(): string
    {
        return $this->key_attribute;
    }
}
