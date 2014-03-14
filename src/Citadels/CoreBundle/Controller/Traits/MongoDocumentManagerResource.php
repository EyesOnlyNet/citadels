<?php

namespace Citadels\CoreBundle\Controller\Traits;

use Doctrine\ODM\MongoDB\DocumentManager;

trait MongoDocumentManagerResource
{
    /**
     * @var DocumentManager
     */
    private $dm;

    /**
     * @return DocumentManager
     */
    protected function getMongoDocumentManager()
    {
        if (is_null($this->dm)) {
            $this->dm = $this->get('doctrine_mongodb')->getManager();
        }

        return $this->dm;
    }
}
