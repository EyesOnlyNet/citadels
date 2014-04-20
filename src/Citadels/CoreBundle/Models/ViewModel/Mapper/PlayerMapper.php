<?php
namespace Citadels\CoreBundle\Models\ViewModel\Mapper;

use Citadels\CoreBundle\Document\PlayerDoc;
use Citadels\CoreBundle\Models\ViewModel\PlayerView;
use Doctrine\Common\Collections\Collection;

class PlayerMapper
{
    /**
     * @param PlayerDoc $player
     * @return PlayerView
     */
    public static function createFromPlayerDoc(PlayerDoc $player)
    {
        $playerView = new PlayerView();
        $playerView->gold = $player->getGold();
        $playerView->isKing = $player->isKing();
        $playerView->name = $player->getName();
        $playerView->points = $player->getPoints();

        if (!is_null($player->getCharacterCard())) {
            $playerView->character = CharacterMapper::createFromCharacterCardDoc($player->getCharacterCard());
        }

        return $playerView;
    }

    /**
     * @param Collection $players
     * @return Collection
     */
    public static function createFromPlayerDocCollection(Collection $players)
    {
        $closure = function(PlayerDoc $player) {
            return self::createFromPlayerDoc($player);
        };

        return $players->map($closure);
    }
}
