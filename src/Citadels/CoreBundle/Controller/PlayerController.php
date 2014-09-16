<?php

namespace Citadels\CoreBundle\Controller;

use Citadels\CoreBundle\Controller\Traits\MongoDocumentManagerResource;
use Citadels\CoreBundle\Document\GameDoc;
use Citadels\CoreBundle\Document\PlayerDoc;
use Citadels\CoreBundle\Enum\Game;
use Citadels\CoreBundle\Models\ViewModel\Mapper\PlayerMapper;
use Citadels\CoreBundle\Models\ViewModel\PlayerView;
use Doctrine\Common\Collections\ArrayCollection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class PlayerController extends BaseController
{
    use MongoDocumentManagerResource;

    /**
     * @var GameDoc
     */
    private $game;

    public function before()
    {
        parent::before();

        $this->initGame();
    }

    /**
     * @Route("/players/{playerId}/game/{gameId}")
     */
    public function myPlayerAction()
    {
        $playerId = $this->getRequestParam('playerId');
        $player = $this->findPlayer($playerId);

        if ($player == null) {
            return $this->getViewVars();
        }

        $myPlayer = PlayerMapper::createFromPlayerDoc($player);
        $myPlayer->isActive = $this->isPlayerActive($player);

        $this->view->model = $myPlayer;

        return $this->getViewVars();
    }

    /**
     * @Route("/players/game/{gameId}")
     */
    public function playerListAction()
    {
        $players = $this->findPlayers();
        $playerList = PlayerMapper::createFromPlayerDocCollection($players);

        /* @var $player PlayerView */
        foreach ($playerList as $key => $player) {
            $player->isActive = $this->isPlayerActive($players->get($key));
        }

        $this->view->playerList = $playerList;

        return $this->getViewVars();
    }

    /**
     * @Route("/players/{playerId}/game/{gameId}/add-gold")
     */
    public function addGoldAction()
    {
        $player = $this->game->getActivePlayer();
        $player->addGold(Game::GOLD_PER_ROUND);

        $this->getMongoDocumentManager()->flush();

        return new Response;
    }

    /**
     * @Route("/players/{playerId}/name")
     * @Method("post")
     */
    public function setNameAction()
    {
        $playerId = $this->getRequestParam('playerId');
        $playerName = $this->getRequestParam('playerName', $this->getRandomName());

        /* @var $player PlayerDoc */
        $player = $this->game->getPlayers()->filter(function(PlayerDoc $player) use ($playerId) {
            return $player->getId() == $playerId;
        })->first();

        $player->setName($playerName);

        $this->getMongoDocumentManager()->flush();

        return new Response;
    }

    /**
     * @return string
     */
    private function getRandomName()
    {
        $names = [
            'Peter Pan', 'Tinkerbell', 'Hook', 'Wendy', 'Smee', 'Tick', 'Trick', 'Track', 'Donald', 'Dagobert',
        ];

        return $names[array_rand($names)];
    }

    private function initGame()
    {
        $gameId = $this->getRequestParam('gameId');
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

        return $this->game->getPlayers();
    }

    /**
     * @param string $playerId
     * @return PlayerDoc|null
     */
    private function findPlayer($playerId)
    {
        if (is_null($this->game)) {
            return;
        }

        return $this->game->getPlayerById($playerId) ?: null;
    }

    /**
     * @param PlayerDoc $player
     * @return bool
     */
    private function isPlayerActive(PlayerDoc $player)
    {
        $activePlayer = $this->game->getActivePlayer();

        return !is_null($activePlayer) && $activePlayer->getId() == $player->getId();
    }
}
