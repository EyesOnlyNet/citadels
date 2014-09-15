<?php

namespace Citadels\CoreBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ModalController extends BaseController
{
    /**
     * @Route("/modal/player-name")
     * @Route("/modal/player-name/")
     * @Template()
     */
    public function playerNameAction()
    {
        return [];
    }
}
