<?php

namespace Citadels\CoreBundle\Document;

use Citadels\CoreBundle\Document\CharacterCardDoc;
use Citadels\CoreBundle\Document\Traits\UniquePropertiesTrait;
use Citadels\CoreBundle\Enum\CharacterCardType;
use Citadels\CoreBundle\Enum\PlayerProperty;
use Citadels\CoreBundle\Traits\UuidTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations\EmbeddedDocument;
use Doctrine\ODM\MongoDB\Mapping\Annotations\EmbedMany;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Id;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Int;
use Doctrine\ODM\MongoDB\Mapping\Annotations\ReferenceOne;
use Doctrine\ODM\MongoDB\Mapping\Annotations\String;

/**
 * @EmbeddedDocument
 */
class PlayerDoc extends BaseDoc
{
    use UuidTrait;
    use UniquePropertiesTrait;

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
        CharacterCardType::ASSASSIN,
        CharacterCardType::BUILDER,
        CharacterCardType::KING,
        CharacterCardType::MAGICIAN,
        CharacterCardType::MERCENARY,
        CharacterCardType::PRIEST,
        CharacterCardType::THIEF,
    ];

    /**
     * @Id(strategy="UUID")
     * @var string
     */
    private $id;

    /**
     * @String
     * @var string
     */
    private $name;

    /**
     * @Int
     * @var int
     */
    private $gold;

    /**
     * @ReferenceOne(targetDocument="CharacterCardDoc", simple=true)
     * @var CharacterCardDoc
     */
    private $characterCard;

    /**
     * @EmbedMany(targetDocument="BuildingCardDoc")
     * @var ArrayCollection
     */
    private $buildings;

    /**
     * @EmbedMany(targetDocument="BuildingCardDoc")
     * @var ArrayCollection
     */
    private $handCards;

    /**
     * @param string $id
     */
    public function __construct($id = null)
    {
        parent::__construct();

        $this->id = $id ?: $this->getUuidV4(4);
        $this->setProperties([]);
        $this->setBuildings(new ArrayCollection());
        $this->setHandCards(new ArrayCollection());

        $this->setupDummyData();
    }

    private function setupDummyData()
    {
        $character = self::$characterTypes[array_rand(self::$characterTypes)];
        $this->setName(self::$randomNames[array_rand(self::$randomNames)]);
        $this->setGold(rand(0,  10));
        $this->setCharacterCard(new CharacterCardDoc($character));
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
        $this->gold += (int) $value;
        $this->setGold($gold);
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = (string) $name;
    }

    /**
     * @param int $gold
     */
    public function setGold($gold)
    {
        $this->gold = (int) $gold;
    }
}
