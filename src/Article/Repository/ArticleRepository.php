<?php declare(strict_types=1);

namespace EryseBlog\Article\Repository;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\Persistence\ManagerRegistry;
use EryseBlog\Article\Entity\ArticleEntity;
use EryseBlog\Common\Repository\AbstractRepository;
use Exception;

/**
 * @method ArticleEntity|null findOneBy(array $criteria, array $orderBy = null)
 */
class ArticleRepository extends AbstractRepository
{
    /**
     * UserRepository constructor.
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArticleEntity::class);
    }

    /**
     * @return ArrayCollection
     *
     * @throws Exception
     */
    public function findAllVisible(): ArrayCollection
    {
        return new ArrayCollection(
            $this->createQueryBuilder('article')->where('article.public = true')->andWhere(
                'article.datePublished <= :currentDate'
            )->orderBy('article.id', 'DESC')->setParameter('currentDate', date('Y-m-d'))->getQuery()->getResult()
        );
    }

    /**
     * @return ArrayCollection
     */
    public function findAllForAdmin(): ArrayCollection
    {
        return new ArrayCollection($this->findBy([], ['id' => 'DESC']));
    }

    /**
     * @param ArticleEntity $article
     *
     * @return ArticleEntity|null
     * @throws NonUniqueResultException
     */
    public function findPrevious(ArticleEntity $article): ?ArticleEntity
    {
        return $this->createQueryBuilder('article')
            ->where('article.public = true')
            ->andWhere('article.id < :currentId')
            ->orderBy('article.id')
            ->setParameter('currentId', $article->getId())
            ->setFirstResult(0)
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @param ArticleEntity $article
     *
     * @return ArticleEntity|null
     * @throws NonUniqueResultException
     */
    public function findNext(ArticleEntity $article): ?ArticleEntity
    {
        return $this->createQueryBuilder('article')
            ->where('article.public = true')
            ->andWhere('article.id > :currentId')
            ->orderBy('article.id')
            ->setParameter('currentId', $article->getId())
            ->setFirstResult(0)
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
