<?php
namespace Citadels\CoreBundle\Document;

use Citadels\CoreBundle\Traits\UuidTrait;
use Citadels\CoreBundle\Document\Traits\UniquePropertiesTrait;
use Citadels\CoreBundle\Enum\CharacterCardProperty;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Id;
use Doctrine\ODM\MongoDB\Mapping\Annotations\EmbeddedDocument;
use Doctrine\ODM\MongoDB\Mapping\Annotations\String;

/**
 * @EmbeddedDocument
 */
class CharacterCardDoc extends BaseDoc
{
    use UuidTrait;
    use UniquePropertiesTrait;

    /**
     * @Id(strategy="UUID")
     * @var string
     */
    private $id;

    /**
     * @String
     * @var string
     */
    private $type;

    /**
     * @param string $type
     */
    public function __construct($type)
    {
        parent::__construct();

        $this->id = $this->getUuidV4(4);
        $this->setType($type);
        $this->setProperties([]);
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = (string) $type;
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return in_array(CharacterCardProperty::ACTIVE, $this->getProperties());
    }
 }
