<?php

namespace Citadels\CoreBundle\Controller\Traits\Service;

use Citadels\CoreBundle\DependencyInjection\Service\CharacterCardService;

trait CharacterCardServiceResource
{
    /**
     * @return CharacterCardService
     */
    protected function getCharacterCardService()
    {
        return $this->get('citadels_core.character_card_service');
    }
}
