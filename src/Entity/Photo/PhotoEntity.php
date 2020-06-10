<?php declare(strict_types=1);

namespace EryseBlog\Entity\Photo;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use EryseBlog\Entity\Article\ArticleEntity;
use EryseBlog\Entity\Identifier;
use Exception;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity
 * @ORM\Table(name="photo")
 * @Vich\Uploadable
 */
class PhotoEntity
{
    use Identifier;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private string $image = '';

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private string $label = '';

    /**
     * @Vich\UploadableField(mapping="gallery_photos", fileNameProperty="image")
     * @var File
     */
    private ?File $imageFile = null;

    /**
     * @ORM\Column(type="datetime")
     * @var DateTime
     */
    private ?DateTime $updatedAt = null;

    /**
     * @ORM\ManyToOne(targetEntity="EryseBlog\Entity\Article\ArticleEntity", inversedBy="photos")
     */
    private ?ArticleEntity $article = null;

    /**
     * @param File|null $image
     *
     * @throws Exception
     */
    public function setImageFile(File $image = null): void
    {
        $this->imageFile = $image;

        if ($image) {
            $this->updatedAt = new DateTime('now');
        }
    }

    /**
     * @return File
     */
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    /**
     * @param $image
     */
    public function setImage($image): void
    {
        $this->image = $image;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $label
     */
    public function setLabel(string $label): void
    {
        $this->label = $label;
    }

    /**
     * @return ArticleEntity|null
     */
    public function getArticle(): ?ArticleEntity
    {
        return $this->article;
    }

    /**
     * @param ArticleEntity|null $article
     */
    public function setArticle(?ArticleEntity $article): void
    {
        $this->article = $article;
    }
}
