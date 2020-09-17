<?php

namespace App\Entity;

use App\Repository\EquipmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\Timestampable;

/**
 * @ORM\Entity(repositoryClass=EquipmentRepository::class)
 */
class Equipment
{
    use Timestampable;
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=Box::class, inversedBy="equipment")
     */
    private $box;

    /**
     * @ORM\ManyToMany(targetEntity=Runes::class, inversedBy="equipment")
     */
    private $runes;

    public function __construct()
    {
        $this->box = new ArrayCollection();
        $this->runes = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Box[]
     */
    public function getBox(): Collection
    {
        return $this->box;
    }

    public function addBox(Box $box): self
    {
        if (!$this->box->contains($box)) {
            $this->box[] = $box;
        }

        return $this;
    }

    public function removeBox(Box $box): self
    {
        if ($this->box->contains($box)) {
            $this->box->removeElement($box);
        }

        return $this;
    }

    /**
     * @return Collection|Runes[]
     */
    public function getRunes(): Collection
    {
        return $this->runes;
    }

    public function addRune(Runes $rune): self
    {
        if (!$this->runes->contains($rune)) {
            $this->runes[] = $rune;
        }

        return $this;
    }

    public function removeRune(Runes $rune): self
    {
        if ($this->runes->contains($rune)) {
            $this->runes->removeElement($rune);
        }

        return $this;
    }
    

}
