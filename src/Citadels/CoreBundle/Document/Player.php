<?php

namespace Citadels\CoreBundle\Document;

use Citadels\CoreBundle\Document\CharacterCard;
use Citadels\CoreBundle\Models\Card\BuildingCardCollection;
use Citadels\CoreBundle\Enum\CharacterType;
use Citadels\CoreBundle\Traits\UuidTrait;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\EmbeddedDocument
 */
class Player
{
    use UuidTrait;

    /**
     * @MongoDB\Id(strategy="UUID")
     * @var string
     */
    public $id;

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
     * @MongoDb\EmbedOne(targetDocument="CharacterCard")
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

    function __construct()
    {
        $this->id = $this->getUuidV4(4);
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

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getGold()
    {
        return $this->gold;
    }
}
