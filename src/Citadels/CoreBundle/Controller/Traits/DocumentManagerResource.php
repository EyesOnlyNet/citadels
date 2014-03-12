<?php

namespace Citadels\CoreBundle\Controller\Traits;

use Doctrine\ODM\MongoDB\DocumentManager;

trait DocumentManagerResource
{
    /**
     * @return DocumentManager
     */
    protected function getDocumentManager()
    {
        return $this->get('doctrine_mongodb')->getManager();
    }
}
