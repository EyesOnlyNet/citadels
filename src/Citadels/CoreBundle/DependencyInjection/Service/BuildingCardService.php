<?php

namespace Citadels\CoreBundle\DependencyInjection\Service;

use Citadels\CoreBundle\Models\Card\BuildingCard;
use Citadels\CoreBundle\Models\Card\BuildingCardCollection;

class BuildingCardService
{
    /**
     * @var BuildingCardCollection
     */
    private $cards;

    /**
     * @param array[] $cards
     */
    public function __construct(array $cards)
    {
        $this->cards = new BuildingCardCollection();

        foreach ($cards as $cardData) {
            $this->cards->set($cardData['type'], $this->createCardFromArray($cardData));
        }
    }

    /**
     * @param mixed[] $cardData
     * @return BuildingCard
     */
    private function createCardFromArray(array $cardData)
    {
        $points = key_exists('points', $cardData) ? $cardData['points'] : $cardData['cost'];

        return new BuildingCard($cardData['name'], $cardData['type'], $cardData['cost'], $points);
    }

    /**
     * @return BuildingCardCollection
     */
    public function getCards()
    {
        return $this->cards;
    }

    /**
     * @param string $type
     * @return BuildingCard
     */
    public function getCard($type)
    {
        return $this->cards->get($type);
    }
}
