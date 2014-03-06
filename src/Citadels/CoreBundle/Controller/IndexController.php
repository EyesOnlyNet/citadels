<?php

namespace Citadels\CoreBundle\Controller;

use Citadels\CoreBundle\Controller\Traits\Service\BuildingCardServiceResource;
use Citadels\CoreBundle\Controller\Traits\Service\CharacterCardServiceResource;
use Citadels\CoreBundle\Models\CharacterList;
use Citadels\CoreBundle\Models\Player\Player;
use Doctrine\Common\Collections\ArrayCollection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class IndexController extends BaseController
{
    use CharacterCardServiceResource;
    use BuildingCardServiceResource;

    /**
     * @Route("/index", name="_index")
     * @Template()
     */
    public function welcomeAction()
    {
        return $this->getViewVars();
    }

    /**
     * @Route("/index/field", name="_field")
     * @Template()
     */
    public function fieldAction()
    {
        $characterCardService = $this->getCharacterCardService();
        $buildingCardService = $this->getBuildingCardService();
        $buildingCards = $buildingCardService->getCards();
        $player = new Player();

        $characterCards = new ArrayCollection();
        foreach (CharacterList::$order as $characterType) {
            $characterCards->set($characterType, $characterCardService->getCard($characterType));
        }

        $characterType = CharacterList::$order[rand(0, count(CharacterList::$order) - 1)];

        $player->name = 'Peter Pan';
        $player->gold = 12;
        $player->setCharacter($characterCardService->getCard($characterType));
        $player->setBuildings($buildingCards);

        $this->view->player = $player;
        $this->view->characterCards = $characterCards;
        $this->view->buildingCards = $buildingCards;

        return $this->getViewVars();
    }

    /**
     * @Route("/index/list", name="_list")
     * @Template()
     */
    public function listAction()
    {
        return $this->getViewVars();
    }
}
