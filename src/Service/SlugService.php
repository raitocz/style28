<?php declare(strict_types=1);

namespace EryseBlog\Service;

use EryseBlog\Exception\SlugException;

class SlugService
{
    /**
     * @param $text
     *
     * @return false|string|string[]|null
     * @throws SlugException
     */
    public function slugify(string $text): string
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            throw new SlugException('Failed to create slug for:'. $text);
        }

        return $text;
    }
}
