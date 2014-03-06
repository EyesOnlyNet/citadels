<?php

namespace Citadels\CoreBundle\Controller\Traits\Service;

use Citadels\CoreBundle\DependencyInjection\BuildingCardService;

trait BuildingCardServiceResource
{
    /**
     * @return BuildingCardService
     */
    protected function getBuildingCardService()
    {
        return $this->get('citadels_core.building_card_service');
    }
}
