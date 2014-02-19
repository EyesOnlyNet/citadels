<?php

namespace Citadels\CoreBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class IndexController extends BaseController
{
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
        $twig = new \Twig_Environment();
        $twig->addFunction(new \Twig_SimpleFunction('rand', 'rand'));

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
