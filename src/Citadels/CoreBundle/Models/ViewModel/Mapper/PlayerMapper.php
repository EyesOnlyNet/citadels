<?php
namespace Citadels\CoreBundle\Models\ViewModel\Mapper;

use Citadels\CoreBundle\DependencyInjection\Service\PlayerService;
use Citadels\CoreBundle\Document\PlayerDoc;
use Citadels\CoreBundle\Models\ViewModel\PlayerView;
use Doctrine\Common\Collections\Collection;

class PlayerMapper
{
    /**
     * @var PlayerService
     */
    private $playerService;

    /**
     * @var CharacterCardMapper
     */
    private $characterCardMapper;

    /**
     * @param PlayerService $playerService
     * @param CharacterCardMapper $characterCardMapper
     */
    public function __construct(PlayerService $playerService, CharacterCardMapper $characterCardMapper)
    {
        $this->playerService = $playerService;
        $this->characterCardMapper = $characterCardMapper;
    }

    /**
     * @param PlayerDoc $player
     * @return PlayerView
     */
    public function map(PlayerDoc $player)
    {
        $playerView = new PlayerView();
        $playerView->name = $player->getName();
        $playerView->gold = $player->getGold();
        $playerView->isActive = $this->playerService->isActive($player);
        $playerView->isKing = $this->playerService->isKing($player);
        $playerView->points = $this->playerService->getPoints($player);

        if (!is_null($player->getCharacterCard())) {
            $playerView->characterCard = $this->characterCardMapper->map($player->getCharacterCard());
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
