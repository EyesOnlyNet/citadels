<?php

namespace Citadels\CoreBundle\Controller;

use Citadels\CoreBundle\Controller\Traits\MongoDocumentManagerResource;
use Citadels\CoreBundle\Document\GameDoc;
use Citadels\CoreBundle\Models\ViewModel\Mapper\CharacterListMapper;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class CharacterController extends BaseController
{
    use MongoDocumentManagerResource;

    /**
     * @Route("/character-list/game/{gameId}")
     */
    public function characterListAction()
    {
        $gameId = $this->getRequest()->attributes->get('gameId');
        $this->view->characterList = CharacterListMapper::createFromGameDoc($this->findGame($gameId));

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
