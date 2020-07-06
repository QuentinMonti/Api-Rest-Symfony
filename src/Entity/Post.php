<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert; 


/**
 * @ORM\Entity(repositoryClass="App\Repository\PostRepository")
 * @ApiResource
 */
class Post
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups("post:read")  
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups("post:read")  
     */
    private $note;
    
    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("post:read")
     * @Assert\NotBlank(message="Le nom est obligatoire")
     * @Assert\Length(min=3)
     */
    private $firstName;

     /**
     * @ORM\Column(type="string", length=255)
     * @Groups("post:read")
     * @Assert\NotBlank(message="Le nom est obligatoire")
     * @Assert\Length(min=3)
     */
    private $lastName;

    /**
     * @ORM\Column(type="text")
     * @Groups("post:read") 
     * @Assert\NotBlank(message="Le métier est obligatoire")
     * @Assert\Length(min=3)
     */
    private $jobTitle;

    /**
     * @ORM\Column(type="text")
     * @Groups("post:read") 
     * @Assert\NotBlank(message="La ville est obligatoire")
     * @Assert\Length(min=3)
     */
    private $city;

    /**
     * @ORM\Column(type="array", nullable=true)
     * @Groups("post:read") 
     */
    private $competences;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups("post:read")
     */
    private $course;

      /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("post:read")
     * @Assert\NotBlank(message="Le mail est obligatoire")
     * @Assert\Length(min=3)
     */
    private $email;

    /**
     * @ORM\Column(type="datetime")
     * @Groups("post:read") 
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="post")
     * @Groups("post:read") 
     */
    private $comments;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(int $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getJobTitle(): ?string
    {
        return $this->jobTitle;
    }

    public function setJobTitle(string $jobTitle): self
    {
        $this->jobTitle = $jobTitle;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCompetences(): ?array
    {
        return $this->competences;
    }

    public function setCompetences(array $competences): self
    {
        $this->competences = $competences;

        return $this;
    }

    public function getCourse(): ?string
    {
        return $this->course;
    }

    public function setCourse(string $course): self
    {
        $this->course = $course;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setPost($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getPost() === $this) {
                $comment->setPost(null);
            }
        }

        return $this;
    }
}
