<?php
namespace Citadels\CoreBundle\Controller\Traits\Service;

use Citadels\CoreBundle\DependencyInjection\Service\CharacterCardService;

trait CharacterCardServiceResource
{
    /**
     * @var CharacterCardService
     */
    private $characterCardService;

    /**
     * @return CharacterCardService
     */
    protected function getCharacterCardService()
    {
        if (is_null($this->characterCardService)) {
            $this->characterCardService = $this->get('citadels_core.character_card_service');
        }

        return $this->characterCardService;
    }
}
