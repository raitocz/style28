<?php declare(strict_types=1);

namespace EryseBlog\Repository\Gallery;

use Doctrine\Persistence\ManagerRegistry;
use EryseBlog\Entity\Photo\PhotoEntity;
use EryseBlog\Repository\AbstractRepository;

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
}
