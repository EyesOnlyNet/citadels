<?php
namespace Citadels\CoreBundle\Models\ViewModel\Mapper;

use Citadels\CoreBundle\Document\GameDoc;
use Citadels\CoreBundle\Models\ViewModel\GameView;
use Doctrine\Common\Collections\Collection;

class GameMapper
{
    /**
     * @param GameDoc $game
     * @return GameView
     */
    public static function createFromGameDoc(GameDoc $game)
    {
        $gameView = new GameView();
        $gameView->id = $game->getId();
//        $gameView->updatedAt = $game->getModifiedAt()->format('H:i d.m.Y');

        return $gameView;
    }

    /**
     * @param Collection $games
     * @return Collection
     */
    public static function createFromGameDocCollection(Collection $games)
    {
        $closure = function(GameDoc $game) {
            return self::createFromGameDoc($game);
        };

        return $games->map($closure);
    }
}
