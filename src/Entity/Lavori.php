<?php

namespace App\Entity;

use App\Repository\LavoriRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LavoriRepository::class)]
class Lavori
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $specialista = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $intervento = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 8, scale: 2)]
    private ?string $prezzo = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $note = null;

    #[ORM\ManyToOne(inversedBy: 'lavori')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Preventivo $preventivo = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 8, scale: 2, nullable: true)]
    private ?string $pagati = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSpecialista(): ?string
    {
        return $this->specialista;
    }

    public function setSpecialista(string $specialista): self
    {
        $this->specialista = $specialista;

        return $this;
    }

    public function getIntervento(): ?string
    {
        return $this->intervento;
    }

    public function setIntervento(?string $intervento): self
    {
        $this->intervento = $intervento;

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

    public function getPagati(): ?string
    {
        return $this->pagati;
    }

    public function setPagati(?string $pagati): self
    {
        $this->pagati = $pagati;

        return $this;
    }
	
    public function getRestanti(): ?string
    {
        return $this->prezzo - $this->pagati;
    }	

    public function isSaldato(): ?bool
    {
		if ($this->getRestanti() == 0) {
			return true;
		} else {
			return false;
		}        
    }
}
