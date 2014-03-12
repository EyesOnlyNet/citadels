<?php

namespace Citadels\CoreBundle\Document;

use Citadels\CoreBundle\Models\Card\BuildingCardCollection;
use Citadels\CoreBundle\Models\Card\CharacterCard;
use Citadels\CoreBundle\Models\Enum\CharacterType;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class Player
{
    /**
     * @MongoDB\String
     * @var string
     */
    public $userId;

    /**
     * @MongoDB\String
     * @var string
     */
    public $name;

    /**
     * @MongoDB\Int
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
    function __construct($userId = null)
    {
        $this->userId = $userId;
        $this->gold = 0;
        $this->buildings = new BuildingCardCollection();
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
        return $this->character->type === CharacterType::KING;
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
