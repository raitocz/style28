<?php declare(strict_types=1);

namespace EryseBlog\Common\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

abstract class AbstractRepository extends ServiceEntityRepository
{
    /**
     * @param mixed ...$entities
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function save(...$entities): void
    {
        $em = $this->getEntityManager();

        foreach ($entities as $entity) {
            $em->persist($entity);
        }

        $em->flush();
    }

    /**
     * @param mixed ...$entities
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(...$entities): void
    {
        $em = $this->getEntityManager();

        foreach ($entities as $entity) {
            $em->remove($entity);
        }

        $em->flush();
    }
}
