<?php

namespace Citadels\CoreBundle\Controller;

use Citadels\CoreBundle\Controller\Traits\MongoDocumentManagerResource;
use Citadels\CoreBundle\Controller\Traits\Service\CharacterCardServiceResource;
use Citadels\CoreBundle\Document\GameDoc;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class GameController extends BaseController
{
    use CharacterCardServiceResource;
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

        return $this->getViewVars();
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
     * @return GameDoc
     */
    private function createNewGame()
    {
        $game = new GameDoc();
        $characterCardList = $this->getCharacterCardService()->createList();

        foreach ($characterCardList as $card) {
            $this->getMongoDocumentManager()->persist($card);
        }

        $game->setCharacterCardList($characterCardList);

        $this->getMongoDocumentManager()->persist($game);
        $this->getMongoDocumentManager()->flush();

        return $game;
    }
}
