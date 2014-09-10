<?php

namespace Citadels\CoreBundle\Document;

use Citadels\CoreBundle\Document\CharacterCardDoc;
use Citadels\CoreBundle\Enum\CharacterType;
use Citadels\CoreBundle\Traits\UuidTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @MongoDB\EmbeddedDocument
 */
class PlayerDoc extends BaseDoc
{
    use UuidTrait;

    const VALIDATION_GROUP_IS_WINNER = 'isWinner';

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
     * @Assert\GreaterThan ( value=6, groups={"isWinner"} )
     */
    private $gold;

    /**
     * @MongoDb\EmbedOne(targetDocument="CharacterCardDoc")
     * @var CharacterCardDoc
     */
    private $characterCard;

    /**
     * @MongoDb\EmbedMany(targetDocument="BuildingCardDoc")
     * @var ArrayCollection
     */
    private $buildings;

    /**
     * @MongoDb\EmbedMany(targetDocument="BuildingCardDoc")
     * @var ArrayCollection
     */
    private $handCards;

    public function __construct($id = null)
    {
        parent::__construct();

        $this->id = $id ?: $this->getUuidV4(4);
        $this->name = '';
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

        /* @var $building BuildingCardDoc */
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
        return isset($this->characterCard) && $this->characterCard->getType() === CharacterType::KING;;
    }

    /**
     * @param CharacterCardDoc $characterCard
     */
    public function setCharacterCard(CharacterCardDoc $characterCard)
    {
        $this->characterCard = $characterCard;
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
     * @return CharacterCardDoc
     */
    public function getCharacterCard()
    {
        return $this->characterCard;
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
