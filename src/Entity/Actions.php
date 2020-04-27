<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ActionsRepository")
 */
class Actions
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
    private $key_action;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $value;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\States", inversedBy="actions")
     */
    private $states;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getKeyAction(): ?string
    {
        return $this->key_action;
    }

    public function setKeyAction(string $key_action): self
    {
        $this->key_action = $key_action;

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
        return $this->key_action;
    }
}
