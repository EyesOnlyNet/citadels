<?php

namespace Citadels\CoreBundle\DependencyInjection\Service;

use Citadels\CoreBundle\Document\BuildingCardDoc;
use Citadels\CoreBundle\Document\PlayerDoc;
use Citadels\CoreBundle\Enum\CharacterCardType;
use Citadels\CoreBundle\Enum\PlayerProperty;
use Citadels\CoreBundle\Models\ViewModel\Mapper\CharacterCardMapper;

class PlayerService
{
    /**
     * @var CharacterCardService
     */
    private $characterCardService;

    /**
     * @param CharacterCardMapper $characterCardService
     */
    public function __construct(CharacterCardService $characterCardService)
    {
        $this->characterCardService = $characterCardService;
    }

    /**
     * @param PlayerDoc $player
     * @return bool
     */
    public function isKing(PlayerDoc $player)
    {
        $characterCard = $player->getCharacterCard();

        return $characterCard && $characterCard->getType() === CharacterCardType::KING;
    }

    /**
     *
     * @param PlayerDoc $player
     * @return bool
     */
    public function isActive(PlayerDoc $player)
    {
        return in_array(PlayerProperty::ACTIVE, $player->getProperties()) || $player->getCharacterCard()->isActive();
    }

    /**
     * @param PlayerDoc $player
     * @return int
     */
    public function getPoints(PlayerDoc $player)
    {
        $points = 0;

        /* @var $building BuildingCardDoc */
        foreach ($this->getBuildings() as $building) {
            $points += $building->getPoints();
        }

        return $points;
    }
}
