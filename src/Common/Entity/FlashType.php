<?php declare(strict_types=1);

namespace EryseBlog\Common\Entity;

interface FlashType
{
    public const INFO = 'info';
    public const SUCCESS = 'success';
    public const DANGER = 'danger';
    public const WARNING = 'warning';
    public const PRIMARY = 'primary';
}
