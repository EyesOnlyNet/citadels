<?php

namespace Citadels\CoreBundle\Traits\Service;

use Citadels\CoreBundle\DependencyInjection\CharacterCardService;
use Citadels\CoreBundle\Models\Enum\Service;

trait CharacterCardServiceResource
{
    /**
     * @return CharacterCardService
     */
    protected function getCharacterCardService()
    {
        return $this->get(Service::CHARACTER_CARD);
    }
}
