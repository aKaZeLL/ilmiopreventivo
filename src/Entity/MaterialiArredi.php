<?php

namespace App\Entity;

use App\Repository\MaterialiArrediRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MaterialiArrediRepository::class)]
class MaterialiArredi
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $tipologia = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 7, scale: 2)]
    private ?string $prezzo = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $note = null;

    #[ORM\ManyToOne(inversedBy: 'materialiarredi')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Preventivo $preventivo = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTipologia(): ?string
    {
        return $this->tipologia;
    }

    public function setTipologia(string $tipologia): self
    {
        $this->tipologia = $tipologia;

        return $this;
    }

    public function getPrezzo(): ?string
    {
        return $this->prezzo;
    }

    public function setPrezzo(string $prezzo): self
    {
        $this->prezzo = $prezzo;

        return $this;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(?string $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getPreventivo(): ?Preventivo
    {
        return $this->preventivo;
    }

    public function setPreventivo(?Preventivo $preventivo): self
    {
        $this->preventivo = $preventivo;

        return $this;
    }
}
