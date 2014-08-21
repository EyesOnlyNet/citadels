<?php

namespace Citadels\CoreBundle\Controller\Traits\Service;

use Citadels\CoreBundle\DependencyInjection\Service\BuildingCardService;

trait BuildingCardServiceResource
{
    /**
     * @var BuildingCardService
     */
    private $buildingCardService;

    /**
     * @return BuildingCardService
     */
    protected function getBuildingCardService()
    {
        if (is_null($this->buildingCardService)) {
            $this->buildingCardService = $this->get('citadels_core.building_card_service');
        }

        return $this->buildingCardService;
    }
}
