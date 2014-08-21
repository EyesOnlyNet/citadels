<?php

namespace Citadels\CoreBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations\EmbeddedDocument;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Int;
use Doctrine\ODM\MongoDB\Mapping\Annotations\String;

/**
 * @EmbeddedDocument
 */
class BuildingCardDoc
{
    /**
     * @String
     * @var string
     */
    private $name;

    /**
     * @String
     * @var string
     */
    private $type;

    /**
     * @Int
     * @var int
     */
    private $cost;

    /**
     * @Int
     * @var int
     */
    private $points;

    /**
     * @param string $name
     * @param string $type
     * @param int $cost
     * @param int $points
     */
    public function __construct($name, $type, $cost, $points)
    {
        $this->name = $name;
        $this->type = $type;
        $this->cost = $cost;
        $this->points = $points;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return int
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * @return int
     */
    public function getPoints()
    {
        return $this->points;
    }
}
