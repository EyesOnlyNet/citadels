<?php

namespace Citadels\CoreBundle\Controller;

use Citadels\CoreBundle\Controller\Traits\MongoDocumentManagerResource;
use Citadels\CoreBundle\Controller\Traits\Service\CharacterCardServiceResource;
use Citadels\CoreBundle\Document\Game;
use Citadels\CoreBundle\Document\Player;
use Citadels\CoreBundle\Models\CharacterList;
use Doctrine\Common\Collections\ArrayCollection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class GameController extends BaseController
{
    use CharacterCardServiceResource;
    use MongoDocumentManagerResource;

    /**
     * @Route("/game/start")
     * @Route("/game/start/{gameId}")
     * @Route("/game/start/player/{playerId}")
     * @Template()
     */
    public function startAction()
    {
        $game = $this->getGame();

        $this->addPlayerToGame($game);
        $this->getMongoDocumentManager()->persist($game);
        $this->getMongoDocumentManager()->flush();

        $this->view->game = $game;
        $this->view->characterCards = $this->getCharacterCards();

        return $this->getViewVars();
    }

    /**
     * @return Game
     */
    private function getGame()
    {
        $gameId = $this->getRequest()->attributes->get('gameId');
        $playerId = $this->getRequest()->attributes->get('playerId');
        $game = null;

        if (!is_null($gameId)) {
            $game = $this->getMongoDocumentManager()->find('\Citadels\CoreBundle\Document\Game', $gameId);
        }

        if (!is_null($playerId)) {
            $game = $this->getMongoDocumentManager()
                ->getRepository('\Citadels\CoreBundle\Document\Game')
                ->findOneBy(['players.id' => $playerId]);
        }

        if (is_null($game)) {
            $game = new Game();
        }

        return $game;
    }

    /**
     * @param Game $game
     */
    private function addPlayerToGame(Game $game)
    {
        $playerId = $this->getRequest()->attributes->get('playerId');

        if (!is_null($playerId)) {
            return;
        }

        $characterCardService = $this->getCharacterCardService();
        $characterCards = $characterCardService->getCards()->toArray();

        $player = new Player();
        $player->name = 'Steve';
        $player->setCharacter($characterCards[array_rand($characterCards)]);
        $game->addPlayer($player);
    }

    private function getCharacterCards()
    {
        $characterCards = new ArrayCollection();
        foreach (CharacterList::$order as $characterType) {
            $characterCards->set($characterType, $this->getCharacterCardService()->getCard($characterType));
        }

        return $characterCards;
    }
}
