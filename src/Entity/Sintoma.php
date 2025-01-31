<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sintoma
 *
 * @ORM\Table(name="sintoma")
 * @ORM\Entity
 */
class Sintoma
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
     * @ORM\Column(name="sintoma", type="string", length=255, nullable=true)
     */
    private $sintoma;

    /**
     * @var string|null
     *
     * @ORM\Column(name="rubro", type="string", length=255, nullable=true)
     */
    private $rubro;

    /**
     * @var string|null
     *
     * @ORM\Column(name="subrubro", type="string", length=255, nullable=true)
     */
    private $subrubro;

    /**
     * @var string|null
     *
     * @ORM\Column(name="modalidad", type="string", length=255, nullable=true)
     */
    private $modalidad;

     /**
     * @var string|null
     *
     * @ORM\Column(name="relacion", type="string", length=255, nullable=true)
     */
    private $relacion;

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

    public function getRelacion(): ?string
    {
        return $this->relacion;
    }

    public function setRelacion(?string $relacion): self
    {
        $this->relacion = $relacion;

        return $this;
    }

    public function getSintoma(): ?string
    {
        return $this->sintoma;
    }

    public function setSintoma(?string $sintoma): self
    {
        $this->sintoma = $sintoma;

        return $this;
    }

    public function getRubro(): ?string
    {
        return $this->rubro;
    }

    public function setRubro(?string $rubro): self
    {
        $this->rubro = $rubro;

        return $this;
    }

    public function getSubrubro(): ?string
    {
        return $this->subrubro;
    }

    public function setSubrubro(?string $subrubro): self
    {
        $this->subrubro = $subrubro;

        return $this;
    }

    public function getModalidad(): ?string
    {
        return $this->modalidad;
    }

    public function setModalidad(?string $modalidad): self
    {
        $this->modalidad = $modalidad;

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
     * @ORM\ManyToMany(targetEntity="Marca", inversedBy="sintomas")
     * @ORM\JoinTable(name="marcas_sintomas")
     */
    private $marcas;

    public function __construct()
    {
        $this->marcas = new ArrayCollection();
    }

    public function getMarcas()
    {
        return $this->marcas;
    }

    public function addMarca(Marca $marca)
    {
        if (!$this->marcas->contains($marca)) {
            $this->marcas[] = $marca;
            $marca->addSintoma($this);
        }

        return $this;
    }

    public function removeMarca(Marca $marca)
    {
        if ($this->marcas->contains($marca)) {
            $this->marcas->removeElement($marca);
            $marca->removeSintoma($this);
        }

        return $this;
    }


    public function __toString()
    {
        return (string) $this->nombre;
    }
}