<?php

namespace App\Entity;

use App\Repository\PreventivoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PreventivoRepository::class)]
class Preventivo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'preventivi')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\OneToMany(mappedBy: 'preventivo', targetEntity: Lavori::class, orphanRemoval: true)]
    private Collection $lavori;

    #[ORM\OneToMany(mappedBy: 'preventivo', targetEntity: MaterialiArredi::class, orphanRemoval: true)]
    private Collection $materialiarredi;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nome = null;

    #[ORM\Column]
    private ?bool $complete = null;

    public function __construct()
    {
        $this->lavori = new ArrayCollection();
        $this->materialiarredi = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

	public function isOfUser($user): bool
	{
		if ($this->getUser() == $user) {
			return true;
		} else 
			return false;
	}

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Lavori>
     */
    public function getLavori(): Collection
    {
        return $this->lavori;
    }

    public function addLavori(Lavori $lavori): self
    {
        if (!$this->lavori->contains($lavori)) {
            $this->lavori->add($lavori);
            $lavori->setPreventivo($this);
        }

        return $this;
    }

    public function removeLavori(Lavori $lavori): self
    {
        if ($this->lavori->removeElement($lavori)) {
            // set the owning side to null (unless already changed)
            if ($lavori->getPreventivo() === $this) {
                $lavori->setPreventivo(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, MaterialiArredi>
     */
    public function getMaterialiarredi(): Collection
    {
        return $this->materialiarredi;
    }

    public function addMaterialiarredi(MaterialiArredi $materialiarredi): self
    {
        if (!$this->materialiarredi->contains($materialiarredi)) {
            $this->materialiarredi->add($materialiarredi);
            $materialiarredi->setPreventivo($this);
        }

        return $this;
    }

    public function removeMaterialiarredi(MaterialiArredi $materialiarredi): self
    {
        if ($this->materialiarredi->removeElement($materialiarredi)) {
            // set the owning side to null (unless already changed)
            if ($materialiarredi->getPreventivo() === $this) {
                $materialiarredi->setPreventivo(null);
            }
        }

        return $this;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(?string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    public function isComplete(): ?bool
    {
        return $this->complete;
    }

    public function setComplete(bool $complete): self
    {
        $this->complete = $complete;

        return $this;
    }
	
	public function getTotalPriceLavori(): float
    {
		$tot = 0;
        foreach ($this->getLavori() as $l) {
			$tot += (float)$l->getPrezzo();
		}

        return $tot;
    }
	
	public function getRestantiLavori(): float
    {
		$tot = 0;
        foreach ($this->getLavori() as $l) {
			$tot += (float)$l->getRestanti();
		}

        return $tot;
    }
	
	public function getTotalPriceMateriali(): float
    {
		$tot = 0;
        foreach ($this->getMaterialiarredi() as $m) {
			$tot += (float)$m->getPrezzo();
		}

        return $tot;
    }
	
	public function getRestantiMateriali(): float
    {
		$tot = 0;
        foreach ($this->getMaterialiarredi() as $m) {
			$tot += (float)$m->getRestanti();
		}

        return $tot;
    }
}
