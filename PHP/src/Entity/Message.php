<?php

namespace App\Entity;

use App\Repository\MessageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MessageRepository::class)]
class Message
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'messages')]
    private Collection $user_sender_id;

    /**
     * @var Collection<int, User>
     */
    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'content_text')]
    private Collection $user_recipient_id;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content_text = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $content_multimedia = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    public function __construct()
    {
        $this->user_sender_id = new ArrayCollection();
        $this->user_recipient_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUserSenderId(): Collection
    {
        return $this->user_sender_id;
    }

    public function addUserSenderId(User $userSenderId): static
    {
        if (!$this->user_sender_id->contains($userSenderId)) {
            $this->user_sender_id->add($userSenderId);
        }

        return $this;
    }

    public function removeUserSenderId(User $userSenderId): static
    {
        $this->user_sender_id->removeElement($userSenderId);

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUserRecipientId(): Collection
    {
        return $this->user_recipient_id;
    }

    public function addUserRecipientId(User $userRecipientId): static
    {
        if (!$this->user_recipient_id->contains($userRecipientId)) {
            $this->user_recipient_id->add($userRecipientId);
        }

        return $this;
    }

    public function removeUserRecipientId(User $userRecipientId): static
    {
        $this->user_recipient_id->removeElement($userRecipientId);

        return $this;
    }

    public function getContentText(): ?string
    {
        return $this->content_text;
    }

    public function setContentText(string $content_text): static
    {
        $this->content_text = $content_text;

        return $this;
    }

    public function getContentMultimedia(): ?string
    {
        return $this->content_multimedia;
    }

    public function setContentMultimedia(?string $content_multimedia): static
    {
        $this->content_multimedia = $content_multimedia;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }
}
