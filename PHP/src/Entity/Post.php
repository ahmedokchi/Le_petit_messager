<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostRepository::class)]
class Post
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'posts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user_id = null;

    #[ORM\Column(length: 100)]
    private ?string $content_text = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content_multimedia = null;

    #[ORM\Column(nullable: true)]
    private ?array $metadata = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    /**
     * @var Collection<int, Like>
     */
    #[ORM\ManyToMany(targetEntity: Like::class, mappedBy: 'post_id')]
    private Collection $likes;

    /**
     * @var Collection<int, Repost>
     */
    #[ORM\OneToMany(targetEntity: Repost::class, mappedBy: 'post_id')]
    private Collection $reposts;

    /**
     * @var Collection<int, Comment>
     */
    #[ORM\ManyToMany(targetEntity: Comment::class, mappedBy: 'post_id')]
    private Collection $comments;

    /**
     * @var Collection<int, TweetReport>
     */
    #[ORM\ManyToMany(targetEntity: TweetReport::class, mappedBy: 'post_id')]
    private Collection $tweetReports;

    /**
     * @var Collection<int, Favorite>
     */
    #[ORM\ManyToMany(targetEntity: Favorite::class, mappedBy: 'post_id')]
    private Collection $favorites;

    public function __construct()
    {
        $this->likes = new ArrayCollection();
        $this->reposts = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->tweetReports = new ArrayCollection();
        $this->favorites = new ArrayCollection();
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

    public function setContentMultimedia(string $content_multimedia): static
    {
        $this->content_multimedia = $content_multimedia;

        return $this;
    }

    public function getMetadata(): ?array
    {
        return $this->metadata;
    }

    public function setMetadata(?array $metadata): static
    {
        $this->metadata = $metadata;

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

    /**
     * @return Collection<int, Like>
     */
    public function getLikes(): Collection
    {
        return $this->likes;
    }

    public function addLike(Like $like): static
    {
        if (!$this->likes->contains($like)) {
            $this->likes->add($like);
            $like->addPostId($this);
        }

        return $this;
    }

    public function removeLike(Like $like): static
    {
        if ($this->likes->removeElement($like)) {
            $like->removePostId($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Repost>
     */
    public function getReposts(): Collection
    {
        return $this->reposts;
    }

    public function addRepost(Repost $repost): static
    {
        if (!$this->reposts->contains($repost)) {
            $this->reposts->add($repost);
            $repost->setPostId($this);
        }

        return $this;
    }

    public function removeRepost(Repost $repost): static
    {
        if ($this->reposts->removeElement($repost)) {
            // set the owning side to null (unless already changed)
            if ($repost->getPostId() === $this) {
                $repost->setPostId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): static
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->addPostId($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): static
    {
        if ($this->comments->removeElement($comment)) {
            $comment->removePostId($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, TweetReport>
     */
    public function getTweetReports(): Collection
    {
        return $this->tweetReports;
    }

    public function addTweetReport(TweetReport $tweetReport): static
    {
        if (!$this->tweetReports->contains($tweetReport)) {
            $this->tweetReports->add($tweetReport);
            $tweetReport->addPostId($this);
        }

        return $this;
    }

    public function removeTweetReport(TweetReport $tweetReport): static
    {
        if ($this->tweetReports->removeElement($tweetReport)) {
            $tweetReport->removePostId($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Favorite>
     */
    public function getFavorites(): Collection
    {
        return $this->favorites;
    }

    public function addFavorite(Favorite $favorite): static
    {
        if (!$this->favorites->contains($favorite)) {
            $this->favorites->add($favorite);
            $favorite->addPostId($this);
        }

        return $this;
    }

    public function removeFavorite(Favorite $favorite): static
    {
        if ($this->favorites->removeElement($favorite)) {
            $favorite->removePostId($this);
        }

        return $this;
    }

}
