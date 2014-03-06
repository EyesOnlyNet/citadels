<?php

namespace Citadels\CoreBundle\Models\Card;

use Citadels\CoreBundle\Models\Effect\EffectCollection;

class BuildingCard
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $type;

    /**
     * @var int
     */
    public $cost;

    /**
     * @var int
     */
    public $points;

    /**
     * @var EffectCollection
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
    }

    /**
     * @param EffectCollection $effects
     */
    public function setEffects(EffectCollection $effects)
    {
        $this->effects = $effects;
    }

    /**
     * @return EffectCollection
     */
    public function getEffects()
    {
        return $this->effects;
    }
}
