<?php

namespace Citadels\CoreBundle\Controller;

use Citadels\CoreBundle\Controller\Traits\Service\CharacterListServiceResource;
use Citadels\CoreBundle\Controller\Traits\MongoDocumentManagerResource;
use Citadels\CoreBundle\Document\GameDoc;
use Citadels\CoreBundle\Models\ViewModel\Mapper\CharacterListMapper;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class CharacterController extends BaseController
{
    use CharacterListServiceResource;
    use MongoDocumentManagerResource;

    /**
     * @Route("/characters/game/{gameId}")
     */
    public function characterListAction()
    {
        $gameId = $this->getRequestParam('gameId');
        $this->view->characterList = CharacterListMapper::createFromCharacterList($this->getCharacterListService()->getList());

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
