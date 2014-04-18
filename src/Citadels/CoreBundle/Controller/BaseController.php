<?php

namespace Citadels\CoreBundle\Controller;

use ArrayObject;
use Citadels\CoreBundle\Controller\Hooks\BeforeActionHookInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

abstract class BaseController extends Controller implements BeforeActionHookInterface
{
    /**
     * @var ArrayObject
     */
    protected $view;

    public function __construct()
    {
        $this->view = new ArrayObject([], ArrayObject::ARRAY_AS_PROPS);
    }

    final public function before()
    {
        $this->setControllerRequestToView();
    }

    protected function getViewVars()
    {
        return $this->view->getArrayCopy();
    }

    final private function setControllerRequestToView()
    {
        $matches = [];
        $current = $this->getRequest()->attributes->get('_controller');
        preg_match('#(.*)\\\(.*)Bundle\\\Controller\\\(.*)Controller::(.*)Action#', $current, $matches);

        list(, $this->view->project, $this->view->bundle, $this->view->controller, $this->view->action) = $matches;
    }
}
