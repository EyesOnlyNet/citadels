<?php

namespace Citadels\CoreBundle\Models\Card;

use Citadels\CoreBundle\Models\Effect\EffectCollection;

class CharacterCard
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
     * @var string
     */
    public $shortcut;

    /**
     * @var EffectCollection
     */
    private $effects;

    /**
     * @param string $name
     * @param string $type
     * @param string $color
     */
    public function __construct($name, $type, $shortcut)
    {
        $this->name = $name;
        $this->type = $type;
        $this->shortcut = $shortcut;
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
