<?php

namespace Citadels\CoreBundle\Document;

use Citadels\CoreBundle\Document\CharacterCardDoc;
use Citadels\CoreBundle\Enum\CharacterType;
use Citadels\CoreBundle\Traits\UuidTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\EmbeddedDocument
 */
class PlayerDoc extends BaseDoc
{
    use UuidTrait;

    /**
     * @var string[]
     */
    private static $randomNames = [
        'Aladdin',
        'Alice',
        'Anna',
        'Arielle',
        'Aristocat',
        'Aurora',
        'Avenger',
        'Bambi',
        'Belle',
        'Biest',
        'Brave',
        'Buzz Lightyear',
        'Captain America',
        'Cinderella',
        'Daisy Duck',
        'Dalmatiner',
        'Monster',
        'Muppet',
        'Fairy',
        'Doc McStuffin',
        'Donald Duck',
        'Dornröschen',
        'Dory',
        'Duffy',
        'Dumbo',
        'Elsa',
        'Ferkel',
        'Nemo',
        'Finn McMissile',
        'Francesco',
        'Frankenweenie',
        'Goofy',
        'Holley Shiftwell',
        'Hook',
        'Hulk',
        'I-Aah',
        'Iron Man',
        'Jack Skellington',
        'Jack Sparrow',
        'Jake',
        'Pirat',
        'Jasmin',
        'Jessie',
        'Klopfer',
        'Löwe',
        'Frosch',
        'Lightning McQueen',
        'Lilo',
        'Stitch',
        'Lotso',
        'Mack',
        'Marie',
        'Merida',
        'Micky Maus',
        'Minnie Maus',
        'Mulan',
        'Olaf',
        'Periwinkle',
        'Peter Pan',
        'Phineas',
        'Ferb',
        'Pinocchio',
        'Pluto',
        'Pocahontas',
        'Jasmin',
        'Ralph',
        'Rapunzel',
        'Rex',
        'Rosetta',
        'Schneewittchen',
        'Silberhauch',
        'Sofia die Erste',
        'Spider-Man',
        'Squirt',
        'Susi',
        'Strolch',
        'Thor',
        'Tiana',
        'Tigger',
        'Tinkerbell',
        'Tron',
        'Vidia',
        'Violetta',
        'WALL-E',
        'Winnie Puuh',
        'Woody',
        'X-Men',
        'Zwerg',
    ];

    /**
     * @var string[]
     */
    private static $characterTypes = [
        CharacterType::ASSASSIN,
        CharacterType::BUILDER,
        CharacterType::KING,
        CharacterType::MAGICIAN,
        CharacterType::MERCENARY,
        CharacterType::PRIEST,
        CharacterType::THIEF,
    ];

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

        $this->setupDummyData();
    }

    private function setupDummyData()
    {
        $character = self::$characterTypes[array_rand(self::$characterTypes)];
        $this->name = self::$randomNames[array_rand(self::$randomNames)];
        $this->gold = rand(0,  10);
        $this->characterCard = new CharacterCardDoc($character, $character, substr($character, 0, 3));
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
