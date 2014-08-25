<?php

namespace Citadels\CoreBundle\Controller;

use Citadels\CoreBundle\Controller\Traits\Service\BuildingCardServiceResource;
use Citadels\CoreBundle\Controller\Traits\Service\CharacterCardServiceResource;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class IndexController extends BaseController
{
    use CharacterCardServiceResource;
    use BuildingCardServiceResource;

    /**
     * @Route("")
     * @Route("/", name="welcome")
     * @Route("/start")
     * @Route("/start/")
     * @Route("/index")
     * @Route("/index/")
     * @Template()
     */
    public function welcomeAction()
    {
        return $this->getViewVars();
    }
}
