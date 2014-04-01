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
        $gameId = $this->getRequest()->attributes->get('gameId');

        $this->view->game = $this->findGame($gameId) ?: $this->createNewGame();
        $this->view->characterList = $this->getCharacterListService()->getList();

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
}
