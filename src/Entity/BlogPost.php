<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 */
class BlogPost implements CreatedInterface, UpdatedInterface, AuthorInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string")
     */
    private ?string $title = null;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="text")
     */
    private ?string $content = null;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?User $author = null;

    /**
     * @ORM\Column(type="microtime")
     */
    private ?int $created = null;

    /**
     * @ORM\Column(type="microtime")
     */
    private ?int $updated = null;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="blogPost")
     *
     * @var Collection|Comment[]
     */
    private $comments;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }

    /**
     * {@inheritdoc}
     */
    public function setCreated(int $created)
    {
        $this->created = $created;
    }

    /**
     * {@inheritdoc}
     */
    public function getCreated(): ?int
    {
        return $this->created;
    }

    /**
     * {@inheritdoc}
     */
    public function setUpdated(int $updated)
    {
        $this->updated = $updated;
    }

    /**
     * {@inheritdoc}
     */
    public function getUpdated(): ?int
    {
        return $this->updated;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setContent(string $content)
    {
        $this->content = $content;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthor(): ?User
    {
        return $this->author;
    }

    /**
     * {@inheritdoc}
     */
    public function setAuthor(User $author)
    {
        $this->author = $author;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments()
    {
        return $this->comments;
    }
}
