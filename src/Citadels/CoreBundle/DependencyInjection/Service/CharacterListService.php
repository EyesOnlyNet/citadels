<?php

namespace Citadels\CoreBundle\DependencyInjection\Service;

use Citadels\CoreBundle\Enum\CharacterType;
use Doctrine\Common\Collections\ArrayCollection;

class CharacterListService
{
    /**
     * @var string[]
     */
    private static $order = [
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
     * @var CharacterCardService
     */
    private $characterCardService;

    /**
     * @param CharacterCardService $characterCardService
     */
    public function __construct(CharacterCardService $characterCardService)
    {
        $this->characterCardService = $characterCardService;
    }

    /**
     * @return ArrayCollection
     */
    public function getList()
    {
        $list = new ArrayCollection();

        foreach (self::$order as $characterType) {
            $list->set($characterType, $this->characterCardService->getCard($characterType));
        }

        return $list;
    }
}
