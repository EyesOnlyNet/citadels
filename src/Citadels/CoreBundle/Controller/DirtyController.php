<?php

namespace Citadels\CoreBundle\Controller;

use Citadels\CoreBundle\Controller\Traits\MongoDocumentManagerResource;
use Citadels\CoreBundle\Controller\Traits\Service\CharacterCardServiceResource;
use Citadels\CoreBundle\Document\Game;
use Citadels\CoreBundle\Document\Player;
use Citadels\CoreBundle\Enum\CharacterType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DirtyController extends BaseController
{
    use CharacterCardServiceResource;
    use MongoDocumentManagerResource;

    /**
     * @Route("/dirty/test")
     * @Template()
     */
    public function testAction()
    {
        $characterCardService = $this->getCharacterCardService();

        $player = new Player();
        $player->name = 'Steve';
        $player->setCharacter($characterCardService->getCard(CharacterType::ASSASSIN));

        $game = new Game();
        $game->addPlayer($player);

        $dm = $this->getMongoDocumentManager();
        $dm->persist($game);
        $dm->flush();

        return $this->getViewVars();
    }
}
