<?php

namespace Citadels\CoreBundle\DependencyInjection\Service;

use Citadels\CoreBundle\Document\CharacterCardDoc;
use Citadels\CoreBundle\Enum\CharacterCardType;
use Doctrine\Common\Collections\ArrayCollection;

class CharacterCardService
{
    /**
     * @var array[]
     */
    private static $mapping = [
        CharacterCardType::ASSASSIN => ['name' => 'Meuchler'],
        CharacterCardType::BUILDER => ['name' => 'Baumeister'],
        CharacterCardType::CHANDLER => ['name' => 'Händler'],
        CharacterCardType::KING => ['name' => 'König'],
        CharacterCardType::MAGICIAN => ['name' => 'Magier'],
        CharacterCardType::MERCENARY => ['name' => 'Söldner'],
        CharacterCardType::PRIEST => ['name' => 'Priester'],
        CharacterCardType::THIEF => ['name' => 'Dieb'],
    ];

    /**
     * @var array[]
     */
    private static $listOrder = [
        CharacterCardType::ASSASSIN,
        CharacterCardType::THIEF,
        CharacterCardType::MAGICIAN,
        CharacterCardType::KING,
        CharacterCardType::PRIEST,
        CharacterCardType::CHANDLER,
        CharacterCardType::BUILDER,
        CharacterCardType::MERCENARY,
    ];

    /**
     * @param string $type
     * @return CharacterCardDoc
     */
    public function createCardByType($type)
    {
        return new CharacterCardDoc($type);
    }

    /**
     * @return ArrayCollection
     */
    public function createList()
    {
        $list = new ArrayCollection();

        foreach (self::$listOrder as $characterType) {
            $list->set($characterType, $this->createCardByType($characterType));
        }

        return $list;
    }

    /**
     * @param CharacterCardDoc $characterCard
     * @return string
     */
    public function getName(CharacterCardDoc $characterCard)
    {
        return self::$mapping[$characterCard->getType()];
    }

    /**
     * @param CharacterCardDoc $characterCard
     * @return string
     */
    public function getShortcut(CharacterCardDoc $characterCard)
    {
        return substr($this->getName($characterCard), 0, 3);
    }
}
