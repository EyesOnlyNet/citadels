<?php

namespace Citadels\CoreBundle\Traits;

use Doctrine\ODM\MongoDB\Id\UuidGenerator;

trait UuidTrait
{
    /**
     * @param int $length
     * @return string
     */
    protected function getUuidV4($length = null)
    {
        $length = intval($length);
        $uuid = (new UuidGenerator)->generateV4();

        if ($length > 0) {
            $uuid = substr($uuid, 0, $length);
        }

        return $uuid;
    }
}
