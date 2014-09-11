<?php

namespace Citadels\CoreBundle\Controller;

use Citadels\CoreBundle\Controller\Traits\MongoDocumentManagerResource;
use Citadels\CoreBundle\Controller\Traits\Service\CharacterListServiceResource;
use Citadels\CoreBundle\Document\GameDoc;
use Citadels\CoreBundle\Document\PlayerDoc;
use Citadels\CoreBundle\Models\ViewModel\Mapper\GameMapper;
use Doctrine\Common\Collections\ArrayCollection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class GameController extends BaseController
{
    use CharacterListServiceResource;
    use MongoDocumentManagerResource;

    /**
     * @Route("/game/player")
     * @Route("/game/player/")
     * @Route("/game/player/{fingerprint}")
     * @Route("/game/player/{fingerprint}/")
     * @Template()
     */
    public function gameListAction()
    {
        $playerId = $this->getRequestParam('fingerprint');
        $games = new ArrayCollection($this->getMongoDocumentManager()->getRepository(GameDoc::class)->findBy(['players.id' => $playerId]));

        $this->view->gameList = GameMapper::createFromGameDocCollection($games);

        return $this->getViewVars();
    }

    /**
     * @Route("/game/board")
     * @Route("/game/board/", name="game.board")
     * @Route("/game/board/{gameId}")
     * @Template()
     */
    public function boardAction()
    {
        $gameId = $this->getRequestParam('gameId');

        if ($gameId === null) {
            $this->get('session')->getFlashBag()->add('warning', 'Um ein Spiel zu starten, muss eine Spiel-Id angegeben werden.');

            return $this->redirect($this->generateUrl('root'));
        }

        $game = $this->findGame($gameId);

        if ($game === null) {
            $this->get('session')->getFlashBag()->add('warning', 'Zu der Spiel-Id wurde kein Spiel gefunden.');

            return $this->redirect($this->generateUrl('root'));
        }

        $this->view->game = $game;
        $this->view->characterList = $this->getCharacterListService()->getList();

        return $this->getViewVars();
    }

    /**
     * @Route("/game/create")
     * @Route("/game/create/", name="game.create")
     * @Template()
     */
    public function createAction()
    {
        $fingerprint = $this->getRequestParam('fingerprint');
        $game = new GameDoc();
        $player = new PlayerDoc($fingerprint);

        $this->getMongoDocumentManager()->persist($game);
        $this->getMongoDocumentManager()->persist($player);

        $game->addPlayer($player);

        $this->getMongoDocumentManager()->flush();

        $url = sprintf('%s%s', $this->generateUrl('game.board'), $game->getId());

        $this->get('session')->getFlashBag()->add('success', 'Ein neues Spiel wurde erstellt.');

        return $this->redirect($url);
    }

    /**
     * @Route("/game/{gameId}/end-turn/")
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

        $game->setNextActivePlayer();

        if ($this->get('validator')->validate($game->getActivePlayer(), [PlayerDoc::VALIDATION_GROUP_IS_WINNER])->count() == 0) {
            $game->endGame();
            $this->getMongoDocumentManager()->flush();
        }

        return $this->getViewVars();
    }

    /**
     * @Route("/game/{gameId}/results/")
     * @Template()
     */
    public function resultsAction()
    {
        $gameId = $this->getRequestParam('gameId');

        if ($gameId === null) {
            $this->get('session')->getFlashBag()->add('warning', 'Es gibt ein Problem - bitte starten Sie das Spiel erneut.');

            return $this->redirect($this->generateUrl('root'));
        }

        $game = $this->findGame($gameId);

        if ($game === null) {
            $this->get('session')->getFlashBag()->add('warning', 'Zu der Spiel-Id wurde kein Spiel gefunden.');

            return $this->redirect($this->generateUrl('root'));
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
}
