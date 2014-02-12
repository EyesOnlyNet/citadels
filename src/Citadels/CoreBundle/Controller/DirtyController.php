<?php

namespace Citadels\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DirtyController extends Controller
{
    /**
     * @Route("/dirty/test")
     * @Template()
     */
    public function testAction()
    {
        return [];
    }
}
