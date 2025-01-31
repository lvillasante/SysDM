<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Doctrine\ORM\Mapping as ORM;

/**
 * Marca
 *
 * @ORM\Table(name="marca")
 * @ORM\Entity
 */
class Marca
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @var string|null
     *
     * @ORM\Column(name="signo", type="string", length=255, nullable=true)
     */
    private $signo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="asignacion", type="string", length=255, nullable=true)
     */
    private $asignacion;

    /**
     * @var string|null
     *
     * @ORM\Column(name="marca", type="string", length=255, nullable=true)
     */
    private $marca;

    /**
     * @var string|null
     *
     * @ORM\Column(name="color", type="string", length=255, nullable=true)
     */
    private $color;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(?string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getSigno(): ?string
    {
        return $this->signo;
    }

    public function setSigno(?string $signo): self
    {
        $this->signo = $signo;

        return $this;
    }

    public function getAsignacion(): ?string
    {
        return $this->asignacion;
    }

    public function setAsignacion(?string $asignacion): self
    {
        $this->asignacion = $asignacion;

        return $this;
    }

    public function getMarca(): ?string
    {
        return $this->marca;
    }

    public function setMarca(?string $marca): self
    {
        $this->marca = $marca;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }


    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @ORM\ManyToMany(targetEntity="Sintoma", mappedBy="marcas")
     */
    private $sintomas;

    public function __construct()
    {
        $this->sintomas = new ArrayCollection();
    }

    public function getSintomas()
    {
        return $this->sintomas;
    }

    public function addSintoma(Sintoma $sintoma)
    {
        if (!$this->sintomas->contains($sintoma)) {
            $this->sintomas[] = $sintoma;
            $sintoma->addMarca($this);
        }

        return $this;
    }

    public function removeSintoma(Sintoma $sintoma)
    {
        if ($this->sintomas->contains($sintoma)) {
            $this->sintomas->removeElement($sintoma);
            $sintoma->removeMarca($this);
        }

        return $this;
    }

    public function __toString()
    {
        return (string) $this->nombre;
    }
}
