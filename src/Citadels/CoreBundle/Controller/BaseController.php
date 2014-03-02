<?php

namespace Citadels\CoreBundle\Controller;

use ArrayObject;
use Citadels\CoreBundle\Controller\Hooks\BeforeActionHookInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BaseController extends Controller implements BeforeActionHookInterface
{
    /**
     * @var ArrayObject
     */
    protected $view;

    /**
     * @param Request $request
     */
    public function __construct()
    {
        $this->view = new ArrayObject([], ArrayObject::ARRAY_AS_PROPS);
    }

    public function before()
    {
    }

    protected function getViewVars()
    {
        return $this->view->getArrayCopy();
    }
}
