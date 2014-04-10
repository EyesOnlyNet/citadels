<?php

namespace Citadels\CoreBundle\Controller;

use Citadels\CoreBundle\Controller\Traits\MongoDocumentManagerResource;
use Citadels\CoreBundle\Document\GameDoc;
use Citadels\CoreBundle\Document\PlayerDoc;
use Citadels\CoreBundle\Models\ViewModel\Mapper\PlayerMapper;
use Doctrine\Common\Collections\ArrayCollection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class PlayerController extends AjaxController
{
    use MongoDocumentManagerResource;

    /**
     * @Route("/players/{playerId}/game/{gameId}")
     */
    public function myPlayerAction()
    {
        $playerId = $this->getRequest()->attributes->get('playerId');
        $gameId = $this->getRequest()->attributes->get('gameId');
        $this->view->myPlayer = PlayerMapper::createFromPlayerDoc($this->findPlayerOrCreateNew($playerId, $gameId));

        return $this->getAjaxResponse($this->getViewVars());
    }

    /**
     * @Route("/players/game/{gameId}")
     */
    public function playersAction()
    {
        $gameId = $this->getRequest()->attributes->get('gameId');
        $this->view->players = PlayerMapper::createFromPlayerDocCollection($this->findPlayers($gameId));

        return $this->getAjaxResponse($this->getViewVars());
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
     * @param string $gameId
     * @return ArrayCollection
     */
    private function findPlayers($gameId)
    {
        if (is_null($gameId)) {
            return;
        }

        $game = $this->findGame($gameId);

        if (is_null($game)) {
            return;
        }

        return $game->getPlayers();
    }

    /**
     * @param string $playerId
     * @param string $gameId
     * @return PlayerDoc
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
     * @return PlayerDoc
     */
    private function createNewPlayer($playerId, $gameId)
    {
        $player = new PlayerDoc($playerId);
        $this->getMongoDocumentManager()->persist($player);

        $game = $this->findGame($gameId);
        $game->addPlayer($player);

        $this->getMongoDocumentManager()->flush();

        return $player;
    }
}
