<?php

namespace Citadels\CoreBundle\Controller;

use Citadels\CoreBundle\Controller\Traits\MongoDocumentManagerResource;
use Citadels\CoreBundle\Controller\Traits\Service\PlayerMapperResource;
use Citadels\CoreBundle\Document\GameDoc;
use Citadels\CoreBundle\Document\PlayerDoc;
use Citadels\CoreBundle\Models\ViewModel\PlayerView;
use Doctrine\Common\Collections\ArrayCollection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class PlayerController extends AjaxController
{
    use MongoDocumentManagerResource;
    use PlayerMapperResource;

    /**
     * @var GameDoc
     */
    private $game;

    /**
     * @Route("/players/{playerId}/game/{gameId}")
     */
    public function myPlayerAction()
    {
        $this->initGame();

        $playerId = $this->getRequest()->attributes->get('playerId');
        $player = $this->findPlayerOrCreateNew($playerId);

        $myPlayer = $this->getPlayerMapper()->map($player);
        $myPlayer->isActive = $this->isPlayerActive($player);

        $this->view->myPlayer = $myPlayer;

        return $this->getViewVars();
    }

    /**
     * @Route("/players/game/{gameId}")
     */
    public function playerListAction()
    {
        $this->initGame();

        $players = $this->findPlayers();
        $playerList = $this->getPlayerMapper()->mapCollection($players);

        /* @var $player PlayerView */
        foreach ($playerList as $key => $player) {
            $player->isActive = $this->isPlayerActive($players->get($key));
        }

        $this->view->playerList = $playerList;

        return $this->getViewVars();
    }

    private function initGame()
    {
        $gameId = $this->getRequest()->attributes->get('gameId');
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

        return $this->game->getPlayerList();
    }

    /**
     * @param string $playerId
     * @return PlayerDoc
     */
    private function findPlayerOrCreateNew($playerId)
    {
        if (is_null($this->game)) {
            return;
        }

        return $this->game->getPlayerById($playerId) ?: $this->createNewPlayer($playerId);
    }

    /**
     * @param string $playerId
     * @return PlayerDoc
     */
    private function createNewPlayer($playerId)
    {
        $player = new PlayerDoc($playerId);
        $this->getMongoDocumentManager()->persist($player);
        $this->game->addPlayer($player);
        $this->getMongoDocumentManager()->flush();

        return $player;
    }

    /**
     * @param PlayerDoc $player
     * @return bool
     */
    private function isPlayerActive(PlayerDoc $player)
    {
        if (is_null($this->game->getActivePlayer()->getCharacterCard())) {
            return $this->game->getActivePlayer()->getCharacterCard()->getType() === $player->getCharacterCard();
        }

        return false;
    }
}
