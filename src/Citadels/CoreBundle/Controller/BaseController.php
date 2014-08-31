<?php

namespace Citadels\CoreBundle\Controller;

use ArrayObject;
use Citadels\CoreBundle\Controller\Hooks\BeforeActionHookInterface;
use Citadels\CoreBundle\Controller\Traits\SerializerResource;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;


abstract class BaseController extends Controller implements BeforeActionHookInterface
{
    use SerializerResource;

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

    /**
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    protected function getRequestParam($name, $default = null)
    {
        return $this->getRequest()->request->get($name)
            ?: $this->getRequest()->query->get($name)
            ?: $this->getRequest()->attributes->get($name)
            ?: $default;
    }

    /**
     * @return mixed[]
     */
    protected function getViewVars()
    {
        return ($this->getRequest()->isXmlHttpRequest())
            ? $this->getAjaxResponse($this->view)
            : $this->view->getArrayCopy();
    }

    /**
     * @param mixed $data
     * @return JsonResponse
     */
    final private function getAjaxResponse($data)
    {
        $response = new JsonResponse();
        $response->setData(
            $this->getSerializer()->serialize($data, 'json')
        );

        return $response;
    }

    final private function setControllerRequestToView()
    {
        $matches = [];
        $current = $this->getRequest()->attributes->get('_controller');
        preg_match('#(.*)\\\(.*)Bundle\\\Controller\\\(.*)Controller::(.*)Action#', $current, $matches);

        list(, $this->view->project, $this->view->bundle, $this->view->controller, $this->view->action) = $matches;
    }
}
