<?php

namespace Citadels\CoreBundle\Controller;

use Citadels\CoreBundle\Controller\Traits\MongoDocumentManagerResource;
use Citadels\CoreBundle\Document\GameDoc;
use Citadels\CoreBundle\Document\PlayerDoc;
use Citadels\CoreBundle\Enum\Game;
use Citadels\CoreBundle\Models\ViewModel\Mapper\PlayerMapper;
use Citadels\CoreBundle\Models\ViewModel\PlayerView;
use Doctrine\Common\Collections\ArrayCollection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class PlayerController extends BaseController
{
    use MongoDocumentManagerResource;

    /**
     * @var GameDoc
     */
    private $game;

    public function before()
    {
        parent::before();

        $this->initGame();
    }

    /**
     * @Route("/players/{playerId}/game/{gameId}")
     */
    public function myPlayerAction()
    {
        $playerId = $this->getRequestParam('playerId');
        $player = $this->findPlayer($playerId);

        if ($player == null) {
            return $this->getViewVars();
        }

        $myPlayer = PlayerMapper::createFromPlayerDoc($player);
        $myPlayer->isActive = $this->isPlayerActive($player);

        $this->view->myPlayer = $myPlayer;

        return $this->getViewVars();
    }

    /**
     * @Route("/players/game/{gameId}")
     */
    public function playerListAction()
    {
        $players = $this->findPlayers();
        $playerList = PlayerMapper::createFromPlayerDocCollection($players);

        /* @var $player PlayerView */
        foreach ($playerList as $key => $player) {
            $player->isActive = $this->isPlayerActive($players->get($key));
        }

        $this->view->playerList = $playerList;

        return $this->getViewVars();
    }

    /**
     * @Route("/players/{playerId}/game/{gameId}/get-gold")
     */
    public function getGoldAction()
    {
//        $player = $this->game->getActivePlayer();
        $playerId = $this->getRequestParam('playerId');
        $player = $this->findPlayer($playerId);
        $player->addGold(Game::GOLD_PER_ROUND);

        $this->getMongoDocumentManager()->flush();

        return $this->getViewVars();
    }

    private function initGame()
    {
        $gameId = $this->getRequestParam('gameId');
        $this->game = $this->findGame($gameId);
    }

    /**
     * @param string $gameId
     * @return GameDoc
     */
    private function findGame($gameId)
    {
        if (is_null($gameId)) {
            return;
        }

        return $this->getMongoDocumentManager()->find(GameDoc::class, $gameId);
    }

    /**
     * @return ArrayCollection
     */
    private function findPlayers()
    {
        if (is_null($this->game)) {
            return;
        }

        return $this->game->getPlayers();
    }

    /**
     * @param string $playerId
     * @return PlayerDoc
     */
    private function findPlayer($playerId)
    {
        if (is_null($this->game)) {
            return;
        }

        return $this->game->getPlayerById($playerId) ?: null;
    }

    /**
     * @param PlayerDoc $player
     * @return bool
     */
    private function isPlayerActive(PlayerDoc $player)
    {
        return $this->game->getActivePlayer()->getId() == $player->getId();
    }
}
