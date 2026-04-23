<?php

namespace App\Entity;

use App\Repository\ParticipantRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ParticipantRepository::class)]
class Participant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $updateAt = null;

    #[ORM\ManyToOne(inversedBy: 'participants')]
    private ?Campaign $campaign = null;

    #[ORM\OneToOne(mappedBy: 'participant', cascade: ['persist', 'remove'])]
    private ?Payment $payment = null;

    #[ORM\Column]
    private ?bool $isIdentityHidden = null;

    #[ORM\Column]
    private ?bool $isAmountHidden = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTime $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdateAt(): ?\DateTime
    {
        return $this->updateAt;
    }

    public function setUpdateAt(?\DateTime $updateAt): static
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    public function getCampaign(): ?Campaign
    {
        return $this->campaign;
    }

    public function setCampaign(?Campaign $campaign): static
    {
        $this->campaign = $campaign;

        return $this;
    }

    public function getPayment(): ?Payment
    {
        return $this->payment;
    }

    public function setPayment(?Payment $payment): static
    {
        // unset the owning side of the relation if necessary
        if ($payment === null && $this->payment !== null) {
            $this->payment->setParticipant(null);
        }

        // set the owning side of the relation if necessary
        if ($payment !== null && $payment->getParticipant() !== $this) {
            $payment->setParticipant($this);
        }

        $this->payment = $payment;

        return $this;
    }

    public function isIdentityHidden(): ?bool
    {
        return $this->isIdentityHidden;
    }

    public function setIsIdentityHidden(bool $isIdentityHidden): static
    {
        $this->isIdentityHidden = $isIdentityHidden;

        return $this;
    }

    public function isAmountHidden(): ?bool
    {
        return $this->isAmountHidden;
    }

    public function setIsAmountHidden(bool $isAmountHidden): static
    {
        $this->isAmountHidden = $isAmountHidden;

        return $this;
    }
}
