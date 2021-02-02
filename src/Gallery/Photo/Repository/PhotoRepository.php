<?php declare(strict_types=1);

namespace EryseBlog\Gallery\Photo\Repository;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Persistence\ManagerRegistry;
use EryseBlog\Article\Entity\ArticleEntity;
use EryseBlog\Gallery\Photo\Entity\PhotoEntity;
use EryseBlog\Common\Repository\AbstractRepository;

/**
 * @method  PhotoEntity[] findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PhotoRepository extends AbstractRepository
{
    /**
     * UserRepository constructor.
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PhotoEntity::class);
    }

    /**
     * @param ArticleEntity $articleEntity
     *
     * @return ArrayCollection
     */
    public function findAllForArticle(ArticleEntity $articleEntity): ArrayCollection
    {
        return new ArrayCollection($this->findBy(['article', $articleEntity]));
    }
}
