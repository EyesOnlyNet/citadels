<?php

namespace Citadels\CoreBundle\Controller;

use Citadels\CoreBundle\Models\CharacterList;
use Citadels\CoreBundle\Traits\Service\CharacterCardServiceResource;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class IndexController extends BaseController
{
    use CharacterCardServiceResource;

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
        $characterCardsService = $this->getCharacterCardService();
        $characterCards = $characterCardsService->getCardsSortedByCharacterTypes(CharacterList::$order);

        $this->view->characterCards = $characterCards;

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
