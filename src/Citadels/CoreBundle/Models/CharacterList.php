<?php

namespace Citadels\CoreBundle\Models;

use Citadels\CoreBundle\Document\CharacterCard;
use Citadels\CoreBundle\Enum\CharacterType;
use Doctrine\Common\Collections\ArrayCollection;

class CharacterList extends ArrayCollection
{
    const STATUS_IN = 1;
    const STATUS_OUT = 0;

    /**
     * @var string[]
     */
    public static $order = [
        CharacterType::ASSASSIN,
        CharacterType::THIEF,
        CharacterType::MAGICIAN,
        CharacterType::KING,
        CharacterType::PRIEST,
        CharacterType::CHANDLER,
        CharacterType::BUILDER,
        CharacterType::MERCENARY,
    ];

    /**
     * @param \Citadels\CoreBundle\Models\Card\CharacterCard $character
     */
    public function setIn(CharacterCard $character)
    {
        $this->set($character->getType(), self::STATUS_IN);
    }

    /**
     * @param \Citadels\CoreBundle\Models\Card\CharacterCard $character
     */
    public function setOut(CharacterCard $character)
    {
        $this->set($character->getType(), self::STATUS_OUT);
    }

    /**
     * @param \Citadels\CoreBundle\Models\Card\CharacterCard $character
     * @return bool
     */
    public static function isIn(CharacterCard $character)
    {
        return $this->get($character->getType()) === self::STATUS_IN;
    }

    /**
     * @param \Citadels\CoreBundle\Models\Card\CharacterCard $character
     * @return bool
     */
    public static function isOut(CharacterCard $character)
    {
        return $this->get($character->getType()) === self::STATUS_OUT;
    }
}
