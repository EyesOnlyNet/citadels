<?php

namespace Citadels\CoreBundle\Document;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\EmbeddedDocument
 */
class CharacterCardDoc extends BaseDoc
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
     * @MongoDB\String
     * @var string
     */
    private $shortcut;

    /**
     * @var ArrayCollection
     */
    private $effects;

    /**
     * @param string $name
     * @param string $type
     * @param string $color
     */
    public function __construct($name, $type, $shortcut)
    {
        parent::__construct();

        $this->name = $name;
        $this->type = $type;
        $this->shortcut = $shortcut;
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
     * @return string
     */
    public function getShortcut()
    {
        return $this->shortcut;
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
