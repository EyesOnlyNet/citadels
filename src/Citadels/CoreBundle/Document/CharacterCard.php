<?php

namespace Citadels\CoreBundle\Document;

use Citadels\CoreBundle\Models\Effect\EffectCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\EmbeddedDocument
 */
class CharacterCard
{
    /**
     * @MongoDB\String
     * @var string
     */
    public $name;

    /**
     * @MongoDB\String
     * @var string
     */
    public $type;

    /**
     * @MongoDB\String
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
