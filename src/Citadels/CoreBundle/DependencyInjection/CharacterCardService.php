<?php

namespace Citadels\CoreBundle\DependencyInjection;

use Citadels\CoreBundle\Models\Card\CharacterCard;
use Citadels\CoreBundle\Models\Card\CharacterCardCollection;

class CharacterCardService
{
    /**
     * @var CharacterCardCollection
     */
    private $cards;

    /**
     * @param array[] $cards
     */
    public function __construct(array $cards)
    {
        $this->cards = new CharacterCardCollection();

        foreach ($cards as $cardData) {
            $this->cards->add($this->createCardFromArray($cardData));
        }
    }

    /**
     * @param mixed[] $cardData
     * @return CharacterCard
     */
    public function createCardFromArray(array $cardData)
    {
        return new CharacterCard($cardData['name'], $cardData['type']);
    }

    /**
     * @return CharacterCardCollection
     */
    public function getCards()
    {
        return $this->cards;
    }

    /**
     * @param string[] $sorting
     * @return CharacterCardCollection
     */
    public function getCardsSortedByCharacterTypes(array $sorting)
    {
        $cards = $this->cards->toArray();
        $callback = function(CharacterCard $a, CharacterCard $b) use ($sorting) {
            $keyA = array_search($a->type, $sorting);
            $keyB = array_search($b->type, $sorting);

            return $keyA - $keyB;
        };

        usort($cards, $callback);

        return new CharacterCardCollection($cards);
    }
}
