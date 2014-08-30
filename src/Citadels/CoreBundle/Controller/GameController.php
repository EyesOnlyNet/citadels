<?php

namespace Citadels\CoreBundle\Controller;

use Citadels\CoreBundle\Controller\Traits\MongoDocumentManagerResource;
use Citadels\CoreBundle\Controller\Traits\Service\CharacterListServiceResource;
use Citadels\CoreBundle\Document\GameDoc;
use Citadels\CoreBundle\Document\PlayerDoc;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class GameController extends BaseController
{
    use CharacterListServiceResource;
    use MongoDocumentManagerResource;

    /**
     * @Route("/game/start")
     * @Route("/game/start/", name="game.start")
     * @Route("/game/start/{gameId}")
     * @Template()
     */
    public function startAction()
    {
        $gameId = $this->getRequestParam('gameId');

        if ($gameId === null) {
            $this->get('session')->getFlashBag()->add('warning', 'Um ein Spiel zu starten, muss eine Spiel-Id angegeben werden.');

            return $this->redirect($this->generateUrl('welcome'));
        }

        $game = $this->findGame($gameId);

        if ($game === null) {
            $this->get('session')->getFlashBag()->add('warning', 'Zu der Spiel-Id wurde kein Spiel gefunden.');

            return $this->redirect($this->generateUrl('welcome'));
        }

        $this->view->game = $game;
        $this->view->characterList = $this->getCharacterListService()->getList();

        return $this->getViewVars();
    }

    /**
     * @Route("/game/create")
     * @Route("/game/create/", name="game.create")
     * @Route("/game/create/{userName}")
     * @Template()
     */
    public function createAction()
    {
        $userName = $this->getRequestParam('userName');

        if ($userName === null) {
            $this->get('session')->getFlashBag()->add('warning', 'Zum Spielen ist ein Spielername notwendig.');

            return $this->redirect($this->generateUrl('welcome'));
        }

        $game = $this->createGame();
        $player = $this->createPlayer($userName);

        $game->addPlayer($player);

        $this->getMongoDocumentManager()->flush();

        $url = sprintf('%s%s', $this->generateUrl('game.start'), $game->getId());

        $this->get('session')->getFlashBag()->add('success', 'Ein neues Spiel wurde erstellt.');

        return $this->redirect($url);
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
    private function createGame()
    {
        $game = new GameDoc();

        $this->getMongoDocumentManager()->persist($game);

        return $game;
    }

    /**
     * @param string $name
     * @return \Citadels\CoreBundle\Document\PlayerDoc
     */
    private function createPlayer($name)
    {
        $player = new PlayerDoc();
        $player->setName($name);

        $this->getMongoDocumentManager()->persist($player);

        return $player;
    }
}
