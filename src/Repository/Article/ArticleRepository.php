<?php declare(strict_types=1);

namespace EryseBlog\Repository\Article;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Persistence\ManagerRegistry;
use EryseBlog\Entity\Article\ArticleEntity;
use EryseBlog\Repository\AbstractRepository;
use Exception;

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
}
