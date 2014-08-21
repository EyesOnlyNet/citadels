<?php
namespace Citadels\CoreBundle\Document;

use DateTime;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Date;
use Doctrine\ODM\MongoDB\Mapping\Annotations\HasLifecycleCallbacks;
use Doctrine\ODM\MongoDB\Mapping\Annotations\PrePersist;
use Doctrine\ODM\MongoDB\Mapping\Annotations\PreUpdate;

/**
 * @HasLifecycleCallbacks
 */
abstract class BaseDoc
{
    /**
     * @Date
     * @var DateTime
     */
    private $modifiedAt;

    /**
     * @Date
     * @var DateTime
     */
    private $createdAt;

    function __construct()
    {
        $this->modifiedAt = new DateTime();
        $this->createdAt = new DateTime();
    }

    /**
     * @return DateTime
     */
    public function getModifiedAt()
    {
        return $this->modifiedAt;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @PrePersist
     * @PreUpdate
     */
    public function refreshModifiedAt()
    {
        $this->modifiedAt = new DateTime();
    }
}
