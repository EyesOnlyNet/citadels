<?php
namespace Citadels\CoreBundle\Models\ViewModel\Mapper;

use Citadels\CoreBundle\Document\GameDoc;
use Citadels\CoreBundle\Document\PlayerDoc;
use Citadels\CoreBundle\Models\ViewModel\GameView;
use Citadels\CoreBundle\Models\ViewModel\PlayerView;
use Doctrine\Common\Collections\Collection;

class GameMapper
{
    /**
     * @var PlayerMapper
     */
    private $playerMapper;

    /**
     * @var CharacterCardMapper
     */
    private $characterCardMapper;

    /**
     * @param PlayerMapper $playerMapper
     * @param CharacterCardMapper $characterCardMapper
     */
    public function __construct(PlayerMapper $playerMapper, CharacterCardMapper $characterCardMapper)
    {
        $this->playerMapper = $playerMapper;
        $this->characterCardMapper = $characterCardMapper;
    }

    /**
     * @param GameDoc $game
     * @return GameView
     */
    public function map(GameDoc $game)
    {
        $playerView = new PlayerView();
        $playerView->name = $game->getName();
        $playerView->gold = $game->getGold();
        $playerView->isActive = $this->playerMapper->isActive($game);
        $playerView->isKing = $this->playerMapper->isKing($game);
        $playerView->points = $this->playerMapper->getPoints($game);

        if (!is_null($game->getCharacterCard())) {
            $playerView->characterCard = $this->characterCardMapper->map($game->getCharacterCard());
        }

        return $playerView;
    }

    /**
     * @param Collection $players
     * @return Collection
     */
    public function mapCollection(Collection $players)
    {
        $closure = function(PlayerDoc $player) {
            return $this->map($player);
        };

        return $players->map($closure);
    }
}
