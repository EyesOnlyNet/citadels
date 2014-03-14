<?php

namespace Citadels\CoreBundle\Controller\Traits\Service;

use Citadels\CoreBundle\DependencyInjection\Service\CharacterCardService;

trait CharacterCardServiceResource
{
    /**
     * @var CharacterCardService
     */
    private $ccs;

    /**
     * @return CharacterCardService
     */
    protected function getCharacterCardService()
    {
        if (is_null($this->ccs)) {
            $this->ccs = $this->get('citadels_core.character_card_service');
        }

        return $this->ccs;
    }
}
