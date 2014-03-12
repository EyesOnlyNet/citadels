<?php

namespace Citadels\CoreBundle\DependencyInjection\Service;

use Citadels\CoreBundle\Models\Card\CharacterCard;
use Doctrine\Common\Collections\ArrayCollection;

class CharacterCardService
{
    /**
     * @var ArrayCollection
     */
    private $cards;

    /**
     * @param array[] $cards
     */
    public function __construct(array $cards)
    {
        $this->cards = new ArrayCollection();

        foreach ($cards as $cardData) {
            $this->cards->set($cardData['type'], $this->createCardFromArray($cardData));
        }
    }

    /**
     * @param mixed[] $cardData
     * @return CharacterCard
     */
    public function createCardFromArray(array $cardData)
    {
        return new CharacterCard($cardData['name'], $cardData['type'], $cardData['shortcut']);
    }

    /**
     * @return ArrayCollection
     */
    public function getCards()
    {
        return $this->cards;
    }

    /**
     * @param string $type
     * @return CharacterCard
     */
    public function getCard($type)
    {
        return $this->cards->get($type);
    }
}
