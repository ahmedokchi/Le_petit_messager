<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 50)]
    private ?string $first_name = null;

    #[ORM\Column(length: 70)]
    private ?string $last_name = null;

    #[ORM\Column(length: 50)]
    private ?string $usename = null;

    #[ORM\Column(length: 255)]
    private ?string $bio = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $profile_picture = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $banner = null;

    #[ORM\Column]
    private ?bool $account_ban = null;

    #[ORM\Column]
    private ?bool $user_premium = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    /**
     * @var Collection<int, Post>
     */
    #[ORM\OneToMany(targetEntity: Post::class, mappedBy: 'user_id', orphanRemoval: true)]
    private Collection $posts;

    /**
     * @var Collection<int, Like>
     */
    #[ORM\ManyToMany(targetEntity: Like::class, mappedBy: 'user_id')]
    private Collection $likes;

    /**
     * @var Collection<int, Repost>
     */
    #[ORM\OneToMany(targetEntity: Repost::class, mappedBy: 'user_id')]
    private Collection $reposts;

    /**
     * @var Collection<int, Follow>
     */
    #[ORM\ManyToMany(targetEntity: Follow::class, mappedBy: 'follower_id')]
    private Collection $follows;

    /**
     * @var Collection<int, Comment>
     */
    #[ORM\OneToMany(targetEntity: Comment::class, mappedBy: 'user_id')]
    private Collection $comments;

    /**
     * @var Collection<int, TweetReport>
     */
    #[ORM\OneToMany(targetEntity: TweetReport::class, mappedBy: 'user_id')]
    private Collection $tweetReports;

    /**
     * @var Collection<int, AccountReport>
     */
    #[ORM\ManyToMany(targetEntity: AccountReport::class, mappedBy: 'user_signaled_id')]
    private Collection $accountReports;

    /**
     * @var Collection<int, Message>
     */
    #[ORM\ManyToMany(targetEntity: Message::class, mappedBy: 'user_sender_id')]
    private Collection $messages;

    /**
     * @var Collection<int, Message>
     */
    #[ORM\ManyToMany(targetEntity: Message::class, mappedBy: 'user_recipient_id')]
    private Collection $messages_receiver;

    /**
     * @var Collection<int, Favorite>
     */
    #[ORM\OneToMany(targetEntity: Favorite::class, mappedBy: 'user_id')]
    private Collection $favorites;

    public function __construct()
    {
        $this->posts = new ArrayCollection();
        $this->likes = new ArrayCollection();
        $this->reposts = new ArrayCollection();
        $this->follows = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->tweetReports = new ArrayCollection();
        $this->accountReports = new ArrayCollection();
        $this->messages = new ArrayCollection();
        $this->messages_receiver = new ArrayCollection();
        $this->favorites = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): static
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): static
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getUsename(): ?string
    {
        return $this->usename;
    }

    public function setUsename(string $usename): static
    {
        $this->usename = $usename;

        return $this;
    }

    public function getBio(): ?string
    {
        return $this->bio;
    }

    public function setBio(string $bio): static
    {
        $this->bio = $bio;

        return $this;
    }

    public function getProfilePicture(): ?string
    {
        return $this->profile_picture;
    }

    public function setProfilePicture(?string $profile_picture): static
    {
        $this->profile_picture = $profile_picture;

        return $this;
    }

    public function getBanner(): ?string
    {
        return $this->banner;
    }

    public function setBanner(?string $banner): static
    {
        $this->banner = $banner;

        return $this;
    }

    public function isAccountBan(): ?bool
    {
        return $this->account_ban;
    }

    public function setAccountBan(bool $account_ban): static
    {
        $this->account_ban = $account_ban;

        return $this;
    }

    public function isUserPremium(): ?bool
    {
        return $this->user_premium;
    }

    public function setUserPremium(bool $user_premium): static
    {
        $this->user_premium = $user_premium;

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
     * @return Collection<int, Post>
     */
    public function getPosts(): Collection
    {
        return $this->posts;
    }

    public function addPost(Post $post): static
    {
        if (!$this->posts->contains($post)) {
            $this->posts->add($post);
            $post->setUserId($this);
        }

        return $this;
    }

    public function removePost(Post $post): static
    {
        if ($this->posts->removeElement($post)) {
            // set the owning side to null (unless already changed)
            if ($post->getUserId() === $this) {
                $post->setUserId(null);
            }
        }

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
            $like->addUserId($this);
        }

        return $this;
    }

    public function removeLike(Like $like): static
    {
        if ($this->likes->removeElement($like)) {
            $like->removeUserId($this);
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
            $repost->setUserId($this);
        }

        return $this;
    }

    public function removeRepost(Repost $repost): static
    {
        if ($this->reposts->removeElement($repost)) {
            // set the owning side to null (unless already changed)
            if ($repost->getUserId() === $this) {
                $repost->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Follow>
     */
    public function getFollows(): Collection
    {
        return $this->follows;
    }

    public function addFollow(Follow $follow): static
    {
        if (!$this->follows->contains($follow)) {
            $this->follows->add($follow);
            $follow->addFollowerId($this);
        }

        return $this;
    }

    public function removeFollow(Follow $follow): static
    {
        if ($this->follows->removeElement($follow)) {
            $follow->removeFollowerId($this);
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
            $comment->setUserId($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): static
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getUserId() === $this) {
                $comment->setUserId(null);
            }
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
            $tweetReport->setUserId($this);
        }

        return $this;
    }

    public function removeTweetReport(TweetReport $tweetReport): static
    {
        if ($this->tweetReports->removeElement($tweetReport)) {
            // set the owning side to null (unless already changed)
            if ($tweetReport->getUserId() === $this) {
                $tweetReport->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, AccountReport>
     */
    public function getAccountReports(): Collection
    {
        return $this->accountReports;
    }

    public function addAccountReport(AccountReport $accountReport): static
    {
        if (!$this->accountReports->contains($accountReport)) {
            $this->accountReports->add($accountReport);
            $accountReport->addUserSignaledId($this);
        }

        return $this;
    }

    public function removeAccountReport(AccountReport $accountReport): static
    {
        if ($this->accountReports->removeElement($accountReport)) {
            $accountReport->removeUserSignaledId($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Message>
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Message $message): static
    {
        if (!$this->messages->contains($message)) {
            $this->messages->add($message);
            $message->addUserSenderId($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): static
    {
        if ($this->messages->removeElement($message)) {
            $message->removeUserSenderId($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Message>
     */
    public function getMessagesReceiver(): Collection
    {
        return $this->messages_receiver;
    }

    public function addMessageReceiver(Message $messages_receiver): static
    {
        if (!$this->messages_receiver->contains($messages_receiver)) {
            $this->messages_receiver->add($messages_receiver);
            $messages_receiver->addUserRecipientId($this);
        }

        return $this;
    }

    public function removeMessageReceiver(Message $messages_receiver): static
    {
        if ($this->messages_receiver->removeElement($messages_receiver)) {
            $messages_receiver->removeUserRecipientId($this);
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
            $favorite->setUserId($this);
        }

        return $this;
    }

    public function removeFavorite(Favorite $favorite): static
    {
        if ($this->favorites->removeElement($favorite)) {
            // set the owning side to null (unless already changed)
            if ($favorite->getUserId() === $this) {
                $favorite->setUserId(null);
            }
        }

        return $this;
    }
}
