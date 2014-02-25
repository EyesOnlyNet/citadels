<?php

namespace Citadels\CoreBundle\Models\Player;

use Citadels\CoreBundle\Models\Card\BuildingCardCollection;
use Citadels\CoreBundle\Models\Card\CharacterCard;
use Citadels\CoreBundle\Models\Enum\CharacterType;

class Player
{
    /**
     * @var string
     */
    public $userId;

    /**
     * @var string
     */
    public $name;

    /**
     * @var int
     */
    public $gold;

    /**
     * @var CharacterCard
     */
    private $character;

    /**
     * @var BuildingCardCollection
     */
    private $buildings;

    /**
     * @var BuildingCardCollection
     */
    private $handCards;

    /**
     * @param int $userId
     */
    function __construct($userId)
    {
        $this->userId = $userId;
        $this->buildings = new BuildingCardCollection();
        $this->gold = 0;
        $this->handCards = new BuildingCardCollection();
    }

    /**
     * @return int
     */
    public function getPoints()
    {
        return $this->buildings->getPoints();
    }

    /**
     * @return bool
     */
    public function isKing()
    {
        return $this->character->getType() === CharacterType::KING;
    }

    /**
     * @param CharacterCard $character
     */
    public function setCharacter(CharacterCard $character)
    {
        $this->character = $character;
    }

    /**
     * @param BuildingCardCollection $buildings
     */
    public function setBuildings(BuildingCardCollection $buildings)
    {
        $this->buildings = $buildings;
    }

    /**
     * @param BuildingCardCollection $handCards
     */
    public function setHandCards(BuildingCardCollection $handCards)
    {
        $this->handCards = $handCards;
    }

    /**
     * @return CharacterCard
     */
    public function getCharacter()
    {
        return $this->character;
    }

    /**
     * @return BuildingCardCollection
     */
    public function getBuildings()
    {
        return $this->buildings;
    }

    /**
     * @return BuildingCardCollection
     */
    public function getHandCards()
    {
        return $this->handCards;
    }
}
