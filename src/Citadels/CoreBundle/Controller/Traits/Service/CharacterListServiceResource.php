<?php

namespace Citadels\CoreBundle\Controller\Traits\Service;

use Citadels\CoreBundle\DependencyInjection\Service\CharacterListService;

trait CharacterListServiceResource
{
    /**
     * @var CharacterListService
     */
    private $cls;

    /**
     * @return CharacterListService
     */
    protected function getCharacterListService()
    {
        if (is_null($this->cls)) {
            $this->cls = $this->get('citadels_core.character_list_service');
        }

        return $this->cls;
    }
}
