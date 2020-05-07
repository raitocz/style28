<?php declare(strict_types=1);

namespace EryseBlog\Entity\Article;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use EryseBlog\Entity\Identifier;

/**
 * @ORM\Entity()
 */
class ArticleEntity
{
    use Identifier;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private string $title = '';

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private string $author = '';

    /**
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private bool $public = false;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private string $content = '';

    /**
     * @var DateTime
     * @ORM\Column(type="datetime")
     */
    private ?DateTime $dateCreated = null;

    /**
     * @var DateTime
     * @ORM\Column(type="datetime")
     */
    private ?DateTime $datePublished = null;

    /**
     * @var DateTime
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?DateTime $dateEdited = null;

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * @param string $author
     */
    public function setAuthor(string $author): void
    {
        $this->author = $author;
    }

    /**
     * @return bool
     */
    public function isPublic(): bool
    {
        return $this->public;
    }

    /**
     * @param bool $public
     */
    public function setPublic(bool $public): void
    {
        $this->public = $public;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * @return DateTime
     */
    public function getDateCreated(): ?DateTime
    {
        return $this->dateCreated;
    }

    /**
     * @param DateTime $dateCreated
     */
    public function setDateCreated(DateTime $dateCreated): void
    {
        $this->dateCreated = $dateCreated;
    }

    /**
     * @return DateTime
     */
    public function getDatePublished(): ?DateTime
    {
        return $this->datePublished;
    }

    /**
     * @param DateTime $datePublished
     */
    public function setDatePublished(DateTime $datePublished): void
    {
        $this->datePublished = $datePublished;
    }

    /**
     * @return DateTime
     */
    public function getDateEdited(): ?DateTime
    {
        return $this->dateEdited;
    }

    /**
     * @param DateTime $dateEdited
     */
    public function setDateEdited(DateTime $dateEdited): void
    {
        $this->dateEdited = $dateEdited;
    }
}
