<?php

namespace Citadels\CoreBundle\Controller;

use Citadels\CoreBundle\Controller\Traits\MongoDocumentManagerResource;
use Citadels\CoreBundle\Controller\Traits\Service\CharacterListServiceResource;
use Citadels\CoreBundle\Document\Game;
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
        $game = $this->getGame();

        $this->view->game = $game;
        $this->view->characterList = $this->getCharacterListService()->getList();

        return $this->getViewVars();
    }

    /**
     * @return Game
     */
    private function getGame()
    {
        $gameId = $this->getRequest()->attributes->get('gameId');

        return $this->findGameById($gameId) ?: new Game();
    }

    /**
     * @param int $gameId
     * @return Game
     */
    private function findGameById($gameId)
    {
        if (is_null($gameId)) {
            return;
        }

        return $this->getMongoDocumentManager()->find('\Citadels\CoreBundle\Document\Game', $gameId);
    }
}
