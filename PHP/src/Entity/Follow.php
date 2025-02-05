<?php

namespace App\Entity;

use App\Repository\FollowRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FollowRepository::class)]
class Follow
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'follows')]
    private Collection $follower_id;

    /**
     * @var Collection<int, User>
     */
    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'follows')]
    private Collection $following_id;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    public function __construct()
    {
        $this->follower_id = new ArrayCollection();
        $this->following_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, User>
     */
    public function getFollowerId(): Collection
    {
        return $this->follower_id;
    }

    public function addFollowerId(User $followerId): static
    {
        if (!$this->follower_id->contains($followerId)) {
            $this->follower_id->add($followerId);
        }

        return $this;
    }

    public function removeFollowerId(User $followerId): static
    {
        $this->follower_id->removeElement($followerId);

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getFollowingId(): Collection
    {
        return $this->following_id;
    }

    public function addFollowingId(User $followingId): static
    {
        if (!$this->following_id->contains($followingId)) {
            $this->following_id->add($followingId);
        }

        return $this;
    }

    public function removeFollowingId(User $followingId): static
    {
        $this->following_id->removeElement($followingId);

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
