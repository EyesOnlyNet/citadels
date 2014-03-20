<?php

namespace Citadels\CoreBundle\Document;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\EmbeddedDocument
 */
class BuildingCard
{
    /**
     * @MongoDB\String
     * @var string
     */
    private $name;

    /**
     * @MongoDB\String
     * @var string
     */
    private $type;

    /**
     * @MongoDB\Int
     * @var int
     */
    private $cost;

    /**
     * @MongoDB\Int
     * @var int
     */
    private $points;

    /**
     * @MongoDb\EmbedMany(targetDocument="Effect")
     * @var ArrayCollection
     */
    private $effects;

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
        $this->effects = new ArrayCollection();
    }

    /**
     * @param ArrayCollection $effects
     */
    public function setEffects(ArrayCollection $effects)
    {
        $this->effects = $effects;
    }

    /**
     * @return ArrayCollection
     */
    public function getEffects()
    {
        return $this->effects;
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

    /**
     * @MongoDB\PostPersist
     * @MongoDB\PostLoad
     * @MongoDB\PostUpdate
     */
    public function after()
    {
        $this->effects = new ArrayCollection($this->effects ? $this->effects->toArray() : []);
    }
}
