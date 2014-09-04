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
     * @Route("/game/board")
     * @Route("/game/board/", name="game.start")
     * @Route("/game/board/{gameId}")
     * @Template()
     */
    public function boardAction()
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
        $fingerprint = $this->getRequestParam('fingerprint');
        $userName = $this->getRequestParam('userName');

        if ($userName === null) {
            $this->get('session')->getFlashBag()->add('warning', 'Zum Spielen ist ein Spielername notwendig.');

            return $this->redirect($this->generateUrl('welcome'));
        }

        $game = $this->createGame();
        $player = $this->createPlayer($userName, $fingerprint);

        $game->addPlayer($player);

        $this->getMongoDocumentManager()->flush();

        $url = sprintf('%s%s', $this->generateUrl('game.start'), $game->getId());

        $this->get('session')->getFlashBag()->add('success', 'Ein neues Spiel wurde erstellt.');

        return $this->redirect($url);
    }

    /**
     * @Route("/game/end-turn")
     * @Route("/game/end-turn/", name="game.endTurn")
     * @Route("/game/end-turn/{gameId}")
     * @Template()
     */
    public function endTurnAction()
    {
        $gameId = $this->getRequestParam('gameId');

        if ($gameId === null) {
            $this->view->error = true;

            return $this->getViewVars();
        }

        $game = $this->findGame($gameId);

        if ($game === null) {
            $this->view->error = true;

            return $this->getViewVars();
        }

        $game->nextTurn();

        $this->view->gameState = $game->getState();

        return $this->getViewVars();
    }

    /**
     * @Route("/game/results")
     * @Route("/game/results/", name="game.results")
     * @Route("/game/results/{gameId}")
     * @Template()
     */
    public function resultsAction()
    {
        $gameId = $this->getRequestParam('gameId');

        if ($gameId === null) {
            $this->get('session')->getFlashBag()->add('warning', 'Es gibt ein Problem - bitte starten Sie das Spiel erneut.');

            return $this->redirect($this->generateUrl('welcome'));
        }

        $game = $this->findGame($gameId);

        if ($game === null) {
            $this->get('session')->getFlashBag()->add('warning', 'Zu der Spiel-Id wurde kein Spiel gefunden.');

            return $this->redirect($this->generateUrl('welcome'));
        }

        $this->view->game = $game;

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
    private function createGame()
    {
        $game = new GameDoc();

        $this->getMongoDocumentManager()->persist($game);

        return $game;
    }

    /**
     * @param string $name
     * @param string $id
     * @return PlayerDoc
     */
    private function createPlayer($name, $id = null)
    {
        $player = new PlayerDoc($id);
        $player->setName($name);

        $this->getMongoDocumentManager()->persist($player);

        return $player;
    }
}
