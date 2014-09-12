<?php

namespace Citadels\CoreBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ModalController extends BaseController
{
    /**
     * @Route("/modal/player-name/{fingerprint}")
     * @Template()
     */
    public function playerNameAction()
    {
        $this->view->playerId = $this->getRequestParam('fingerprint');

        return $this->getViewVars();
    }
}
