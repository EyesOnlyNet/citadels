<?php

namespace Citadels\CoreBundle\Document;

use Citadels\CoreBundle\Document\CharacterCard;
use Citadels\CoreBundle\Enum\CharacterType;
use Citadels\CoreBundle\Traits\UuidTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\EmbeddedDocument
 * @MongoDB\HasLifecycleCallbacks
 */
class Player
{
    use UuidTrait;

    /**
     * @MongoDB\Id(strategy="UUID")
     * @var string
     */
    private $id;

    /**
     * @MongoDB\String
     * @var string
     */
    private $name;

    /**
     * @MongoDB\Int
     * @var int
     */
    private $gold;

    /**
     * @MongoDb\EmbedOne(targetDocument="CharacterCard")
     * @var CharacterCard
     */
    private $character;

    /**
     * @MongoDb\EmbedMany(targetDocument="BuildingCard")
     * @var ArrayCollection
     */
    private $buildings;

    /**
     * @MongoDb\EmbedMany(targetDocument="BuildingCard")
     * @var ArrayCollection
     */
    private $handCards;

    function __construct($id = null)
    {
        $this->id = $id ?: $this->getUuidV4(4);
        $this->gold = 0;
        $this->buildings = new ArrayCollection();
        $this->handCards = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getPoints()
    {
        $points = 0;

        /* @var $building BuildingCard */
        foreach ($this->buildings as $building) {
            $points += $building->getPoints();
        }

        return $points;
    }

    /**
     * @return bool
     */
    public function isKing()
    {
        return isset($this->character) && $this->character->getType() === CharacterType::KING;
    }

    /**
     * @param CharacterCard $character
     */
    public function setCharacter(CharacterCard $character)
    {
        $this->character = $character;
    }

    /**
     * @param ArrayCollection $buildings
     */
    public function setBuildings(ArrayCollection $buildings)
    {
        $this->buildings = $buildings;
    }

    /**
     * @param ArrayCollection $handCards
     */
    public function setHandCards(ArrayCollection $handCards)
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
     * @return ArrayCollection
     */
    public function getBuildings()
    {
        return $this->buildings;
    }

    /**
     * @return ArrayCollection
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

    /**
     * @param int $value
     */
    public function addGold($value)
    {
        $this->gold += $value;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param int $gold
     */
    public function setGold($gold)
    {
        $this->gold = $gold;
    }


}
