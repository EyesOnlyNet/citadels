<?php

namespace Citadels\CoreBundle\EventListener;

use Citadels\CoreBundle\Controller\Hooks\BeforeActionHookInterface;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class BeforeActionListener
{
    /**
     * @param FilterControllerEvent $event
     */
    public function onKernelController(FilterControllerEvent $event) {
        if(HttpKernelInterface::MASTER_REQUEST === $event->getRequestType()) {
            $controllers = $event->getController();

            if(!is_array($controllers)) {
                return;
            }

            $controller = $controllers[0];

            if(is_object($controller) && $controller instanceof BeforeActionHookInterface) {
                $controller->before();
            }
        }
    }
}
