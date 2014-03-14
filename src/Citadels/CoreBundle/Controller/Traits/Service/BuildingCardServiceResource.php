<?php

namespace Citadels\CoreBundle\Controller\Traits\Service;

use Citadels\CoreBundle\DependencyInjection\Service\BuildingCardService;

trait BuildingCardServiceResource
{
    /**
     * @var BuildingCardService
     */
    private $bcs;

    /**
     * @return BuildingCardService
     */
    protected function getBuildingCardService()
    {
        if (is_null($this->bcs)) {
            $this->bcs = $this->get('citadels_core.building_card_service');
        }

        return $this->bcs;
    }
}
