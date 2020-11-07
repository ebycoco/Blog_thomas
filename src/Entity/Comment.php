<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CommentRepository::class)
 */
class Comment
{
    /**
     * @var int|null
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string|null
     * @ORM\Column(nullable=true) 
     * @Assert\NotBlank(groups="anonymous")
     * @Assert\Length(min=2,groups="anonymous")
     */
    private ?string $author = null;

    /**
     * @var string
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     * @Assert\Length(min=5)
     */
    private string $content;

     /**
     * @var \DateTimeImmutable
     * @ORM\Column(type="datetime_immutable")
     */
    private  $postedAt;

    /**
     *
     * @var Post
     * @ORM\ManyToOne(targetEntity="Post",inversedBy="comments")
     */
    private $post;

    /**
     * @var null|User
     * @ORM\ManyToOne(targetEntity="User")
     */
    private ?User $user = null;

    /**
     * constructeur
     */
    public function __construct()
    {
        $this->postedAt = new \DateTimeImmutable;
    }

    /**
     * 
     *
     * @return integer|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

 /**
     * Get the value of author
     *
     * @return  string|null
     */ 
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set the value of author
     *
     * @param  string|null  $author
     *
     * @return  self
     */ 
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }
    /**
     * Get the value of content
     *
     * @return  string
     */ 
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @param  string  $content
     *
     * @return  self
     */ 
    public function setContent(string $content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the value of postedAt
     *
     * @return  \DateTimeImmutable
     */ 
    public function getPostedAt()
    {
        return $this->postedAt;
    }

    /**
     * Set the value of postedAt
     *
     * @param  \DateTimeImmutable  $postedAt
     *
     * @return  self
     */ 
    public function setPostedAt(\DateTimeImmutable $postedAt)
    {
        $this->postedAt = $postedAt;

        return $this;
    }

    /**
     * Get the value of post
     *
     * @return  Post
     */ 
    public function getPost()
    {
        return $this->post;
    }

    /**
     * Set the value of post
     *
     * @param  Post  $post
     *
     * @return  self
     */ 
    public function setPost(Post $post)
    {
        $this->post = $post;

        return $this;
    } 

    /**
     * Get the value of user
     *
     * @return  null|User
     */ 
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @param  null|User  $user
     *
     * @return  self
     */ 
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }
}
