<?php
namespace Citadels\CoreBundle\Controller\Traits;

use Doctrine\ODM\MongoDB\DocumentManager;

trait MongoDocumentManagerResource
{
    /**
     * @var DocumentManager
     */
    private $mongoDocumentManager;

    /**
     * @return DocumentManager
     */
    protected function getMongoDocumentManager()
    {
        if (is_null($this->mongoDocumentManager)) {
            $this->mongoDocumentManager = $this->get('doctrine_mongodb')->getManager();
        }

        return $this->mongoDocumentManager;
    }
}
