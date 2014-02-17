<?php

namespace Citadels\CoreBundle\Controller;

use ArrayObject;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BaseController extends Controller implements BeforeActionHookInterface
{
    /**
     * @var ArrayObject
     */
    protected $view;

    public function __construct()
    {
        $this->view = new ArrayObject([], ArrayObject::ARRAY_AS_PROPS);
    }

    public function before()
    {
        $this->addDefaultStyleSheets();
        $this->addDefaultJavaScripts();
    }

    private function addDefaultStyleSheets()
    {

    }

    private function addDefaultJavaScripts()
    {

    }

    protected function getViewVars()
    {
        return $this->view->getArrayCopy();
    }
}
