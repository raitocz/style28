<?php declare(strict_types=1);

namespace EryseBlog\Article\Frontend\Dto;

use EryseBlog\Article\Entity\ArticleEntity;

/**
 *
 */
class ViewIndexDto
{
    /**
     * @var ArticleEntity
     */
    private ArticleEntity $article;

    /**
     * @var ArticleEntity|null
     */
    private ?ArticleEntity $nextArticle;

    /**
     * @var ArticleEntity|null
     */
    private ?ArticleEntity $previousArticle;

    /**
     * @return ArticleEntity
     */
    public function getArticle(): ArticleEntity
    {
        return $this->article;
    }

    /**
     * @param ArticleEntity $article
     */
    public function setArticle(ArticleEntity $article): void
    {
        $this->article = $article;
    }

    /**
     * @return ArticleEntity|null
     */
    public function getNextArticle(): ?ArticleEntity
    {
        return $this->nextArticle;
    }

    /**
     * @param ArticleEntity|null $nextArticle
     */
    public function setNextArticle(?ArticleEntity $nextArticle): void
    {
        $this->nextArticle = $nextArticle;
    }

    /**
     * @return ArticleEntity|null
     */
    public function getPreviousArticle(): ?ArticleEntity
    {
        return $this->previousArticle;
    }

    /**
     * @param ArticleEntity|null $previousArticle
     */
    public function setPreviousArticle(?ArticleEntity $previousArticle): void
    {
        $this->previousArticle = $previousArticle;
    }
}
