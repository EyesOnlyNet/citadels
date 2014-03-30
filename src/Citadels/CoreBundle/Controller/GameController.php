<?php

namespace Citadels\CoreBundle\Controller;

use Citadels\CoreBundle\Controller\Traits\MongoDocumentManagerResource;
use Citadels\CoreBundle\Controller\Traits\Service\CharacterListServiceResource;
use Citadels\CoreBundle\Document\Game;
use Citadels\CoreBundle\Document\Player;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class GameController extends BaseController
{
    use CharacterListServiceResource;
    use MongoDocumentManagerResource;

    /**
     * @Route("/game/start")
     * @Route("/game/start/{gameId}")
     * @Template()
     */
    public function startAction()
    {
        $gameId = $this->getRequest()->attributes->get('gameId');

        $this->view->game = $this->findGame($gameId) ?: $this->createNewGame();
        $this->view->characterList = $this->getCharacterListService()->getList();

        return $this->getViewVars();
    }

    /**
     * @Route("/game/{gameId}/player/{playerId}")
     * @Template()
     */
    public function myPlayerAction()
    {
        $playerId = $this->getRequest()->attributes->get('playerId');
        $gameId = $this->getRequest()->attributes->get('gameId');

        $this->view->player = $this->findPlayerOrCreateNew($playerId, $gameId);

        return $this->getViewVars();
    }

    /**
     * @param string $gameId
     * @return Game
     */
    private function findGame($gameId)
    {
        if (is_null($gameId)) {
            return;
        }

        return $this->getMongoDocumentManager()->find('\Citadels\CoreBundle\Document\Game', $gameId);
    }

    /**
     * @return Game
     */
    private function createNewGame()
    {
        $game = new Game();

        $this->getMongoDocumentManager()->persist($game);
        $this->getMongoDocumentManager()->flush();

        return $game;
    }

    /**
     * @param string $playerId
     * @param string $gameId
     * @return Player
     */
    private function findPlayerOrCreateNew($playerId, $gameId)
    {
        $game = $this->findGame($gameId);

        if (is_null($game)) {
            return;
        }

        return $game->getPlayerById($playerId) ?: $this->createNewPlayer($playerId, $gameId);
    }

    /**
     * @param string $playerId
     * @param string $gameId
     * @return Player
     */
    private function createNewPlayer($playerId, $gameId)
    {
        $player = new Player($playerId);
        $this->getMongoDocumentManager()->persist($player);

        $game = $this->findGame($gameId);
        $game->addPlayer($player);

        $this->getMongoDocumentManager()->flush();

        return $player;
    }
}
