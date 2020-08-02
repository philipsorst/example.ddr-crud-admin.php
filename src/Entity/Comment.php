<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 */
class Comment implements CreatedInterface, AuthorInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @Assert\NotNull()
     * @ORM\ManyToOne(targetEntity="App\Entity\BlogPost", inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?BlogPost $blogPost = null;

    /**
     * @Assert\NotNull()
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?User $author = null;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", nullable=false)
     */
    private ?string $content = null;

    /**
     * @ORM\Column(type="bigint", nullable=false)
     */
    private ?int $created = null;

    public function __construct(BlogPost $blogPost = null, User $author = null, string $content = null)
    {
        $this->blogPost = $blogPost;
        $this->author = $author;
        $this->content = $content;
    }

    public function getId(): ?int
    {
        return $this->id;
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
    public function setCreated(int $created)
    {
        $this->created = $created;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content)
    {
        $this->content = $content;
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

    public function getBlogPost(): ?BlogPost
    {
        return $this->blogPost;
    }

    public function setBlogPost(BlogPost $blogPost)
    {
        $this->blogPost = $blogPost;
    }

}
