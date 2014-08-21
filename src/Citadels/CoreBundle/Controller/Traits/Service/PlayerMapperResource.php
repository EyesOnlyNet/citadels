<?php
namespace Citadels\CoreBundle\Controller\Traits\Service;

use Citadels\CoreBundle\Models\ViewModel\Mapper\PlayerMapper;

trait PlayerMapperResource
{
    /**
     * @var PlayerMapper
     */
    private $playerMapper;

    /**
     * @return PlayerMapper
     */
    protected function getPlayerMapper()
    {
        if (is_null($this->playerMapper)) {
            $this->playerMapper = $this->get('citadels_core.player_mapper');
        }

        return $this->playerMapper;
    }
}
