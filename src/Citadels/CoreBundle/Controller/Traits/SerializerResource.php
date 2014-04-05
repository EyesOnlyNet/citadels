<?php

namespace Citadels\CoreBundle\Controller\Traits;

use JMS\SerializerBundle\Serializer\Serializer;

trait SerializerResource
{
    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * @return Serializer
     */
    protected function getSerializer()
    {
        if (is_null($this->serializer)) {
            $this->serializer = $this->get('serializer');
        }

        return $this->serializer;
    }
}
