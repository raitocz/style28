<?php declare(strict_types=1);

namespace EryseBlog\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @property int $id
 */
trait Identifier
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\GeneratedValue(strategy="IDENTITY")
     *
     * @var int
     */
    protected int $id;

    /**
     *
     */
    public function __clone()
    {
        $this->id = null;
    }

    /**
     * @return int
     */
    final public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }
}
