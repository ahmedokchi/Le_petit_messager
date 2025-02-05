<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
class Comment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'comments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user_id = null;

    /**
     * @var Collection<int, Post>
     */
    #[ORM\ManyToMany(targetEntity: Post::class, inversedBy: 'comments')]
    private Collection $post_id;

    #[ORM\Column(length: 280)]
    private ?string $content_text = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $content_multimedia = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    public function __construct()
    {
        $this->post_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): static
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * @return Collection<int, Post>
     */
    public function getPostId(): Collection
    {
        return $this->post_id;
    }

    public function addPostId(Post $postId): static
    {
        if (!$this->post_id->contains($postId)) {
            $this->post_id->add($postId);
        }

        return $this;
    }

    public function removePostId(Post $postId): static
    {
        $this->post_id->removeElement($postId);

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
