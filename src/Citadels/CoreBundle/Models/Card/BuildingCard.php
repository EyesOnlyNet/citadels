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
    public $color;

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
     * @param string $color
     * @param int $cost
     * @param int $points
     */
    public function __construct($name, $color, $cost, $points)
    {
        $this->name = $name;
        $this->color = $color;
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
