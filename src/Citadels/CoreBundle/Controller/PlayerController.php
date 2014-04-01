<?php

namespace Citadels\CoreBundle\Controller;

use Citadels\CoreBundle\Controller\Traits\MongoDocumentManagerResource;
use Citadels\CoreBundle\Document\Game;
use Citadels\CoreBundle\Document\Player;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class PlayerController extends BaseController
{
    use MongoDocumentManagerResource;

    /**
     * @Route("/player/{playerId}/game/{gameId}")
     */
    public function myAction()
    {
        $playerId = $this->getRequest()->attributes->get('playerId');
        $gameId = $this->getRequest()->attributes->get('gameId');
        $serializer = $this->get('serializer');

        $response = new JsonResponse();
        $response->setData(
            $serializer->serialize($this->findPlayerOrCreateNew($playerId, $gameId), 'json')
        );

        return $response;
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
