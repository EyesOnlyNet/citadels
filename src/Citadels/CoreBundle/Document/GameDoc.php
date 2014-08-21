<?php

namespace Citadels\CoreBundle\Document;

use Citadels\CoreBundle\Document\PlayerDoc;
use Citadels\CoreBundle\Enum\PlayerProperty;
use Citadels\CoreBundle\Traits\UuidTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations\EmbedMany;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Id;
use Doctrine\ODM\MongoDB\Mapping\Annotations\ReferenceMany;

/**
 * @Document(collection="game")
 */
class GameDoc extends BaseDoc
{
    use UuidTrait;

    /**
     * @Id(strategy="UUID")
     * @var string
     */
    private $id;

    /**
     * @EmbedMany(targetDocument="PlayerDoc")
     * @var ArrayCollection
     */
    private $playerList;

    /**
     * @ReferenceMany(targetDocument="CharacterCardDoc", simple=true)
     * @var ArrayCollection
     */
    private $characterCardList;

    public function __construct()
    {
        parent::__construct();

        $this->id = $this->getUuidV4(4);
        $this->setPlayerList(new ArrayCollection());
        $this->setCharacterCardList(new ArrayCollection());
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return ArrayCollection
     */
    public function getPlayerList()
    {
        return $this->playerList;
    }

    /**
     * @param PlayerDoc $player
     */
    public function addPlayer(PlayerDoc $player)
    {
        if ($this->getPlayerList()->count() == 0) {
            $player->addProperty(PlayerProperty::ACTIVE);
        }

        $this->getPlayerList()->add($player);
    }

    /**
     * @param ArrayCollection $players
     */
    public function setPlayerList(ArrayCollection $players)
    {
        $this->playerList = $players;
    }

    /**
     * @return ArrayCollection
     */
    public function getCharacterCardList()
    {
        return $this->characterCardList;
    }

    /**
     * @param ArrayCollection $characterCardList
     */
    public function setCharacterCardList(ArrayCollection $characterCardList)
    {
        $this->characterCardList = $characterCardList;
    }
}
