<?php

namespace Citadels\CoreBundle\Controller;

use Citadels\CoreBundle\Models\CharacterList;
use Citadels\CoreBundle\Traits\Service\CharacterCardServiceResource;
use Doctrine\Common\Collections\ArrayCollection;
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
        $characterCardService = $this->getCharacterCardService();
        $characterCards = new ArrayCollection();

        foreach (CharacterList::$order as $characterType) {
            $characterCards->set($characterType, $characterCardService->getCard($characterType));
        }

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
