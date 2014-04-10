<?php

namespace Citadels\CoreBundle\DependencyInjection\Service;

use Citadels\CoreBundle\Document\CharacterCardDoc;
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
     * @return CharacterCardDoc
     */
    private function createCardFromArray(array $cardData)
    {
        return new CharacterCardDoc($cardData['name'], $cardData['type'], $cardData['shortcut']);
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
     * @return CharacterCardDoc
     */
    public function getCard($type)
    {
        return $this->cards->get($type);
    }
}
