<?php

namespace Citadels\CoreBundle\Document;

use DateTime;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\HasLifecycleCallbacks
 */
abstract class Base
{
    /**
     * @MongoDB\Date
     * @var DateTime
     */
    private $modifiedAt;

    /**
     * @MongoDB\Date
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
     * @MongoDB\PrePersist
     * @MongoDB\PreUpdate
     */
    public function refreshModifiedAt()
    {
        $this->modifiedAt = new DateTime();
    }
}
