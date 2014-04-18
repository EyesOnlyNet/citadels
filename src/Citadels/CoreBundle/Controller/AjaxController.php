<?php

namespace Citadels\CoreBundle\Controller;

use Citadels\CoreBundle\Controller\Traits\SerializerResource;
use Symfony\Component\HttpFoundation\JsonResponse;

abstract class AjaxController extends BaseController
{
    use SerializerResource;

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

    protected function getViewVars()
    {
        $viewVars = parent::getViewVars();

        return ($this->getRequest()->isXmlHttpRequest())
            ? $this->getAjaxResponse($viewVars)
            : $viewVars;
    }
}
