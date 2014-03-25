<?php

namespace Citadels\CoreBundle\Controller;

use Citadels\CoreBundle\Controller\Traits\MongoDocumentManagerResource;
use Citadels\CoreBundle\Controller\Traits\Service\CharacterCardServiceResource;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DirtyController extends BaseController
{
    use CharacterCardServiceResource;
    use MongoDocumentManagerResource;

    /**
     * @Route("/dirty/test")
     * @Route("/dirty/test/{data}")
     * @Template()
     */
    public function testAction()
    {
        $data = $this->getRequest()->attributes->get('data');

        $this->view->data = $data;

        return $this->getViewVars();
    }
}
