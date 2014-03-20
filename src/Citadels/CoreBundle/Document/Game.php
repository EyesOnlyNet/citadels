<?php

namespace Citadels\CoreBundle\Document;

use Citadels\CoreBundle\Document\Player;
use Citadels\CoreBundle\Traits\UuidTrait;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class Game
{
    use UuidTrait;

    /**
     * @MongoDB\Id(strategy="UUID")
     * @var string
     */
    private $id;

    /**
     * @MongoDb\EmbedMany(targetDocument="Player")
     * @var ArrayCollection
     */
    private $players;

    /**
     * @MongoDb\EmbedOne(targetDocument="Player")
     * @var Player
     */
    private $activePlayer;

    /**
     * @MongoDB\Date
     * @var DateTime
     */
    private $updatedAt;

    /**
     * @MongoDB\Date
     * @var DateTime
     */
    private $createdAt;

    function __construct()
    {
        $this->id = $this->getUuidV4(4);
        $this->players = new ArrayCollection();
        $this->updatedAt = new DateTime();
        $this->createdAt = new DateTime();
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
    public function getPlayers()
    {
        return $this->players;
    }

    /**
     * @return Player
     */
    public function getActivePlayer()
    {
        return $this->activePlayer;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param Player $player
     */
    public function addPlayer(Player $player)
    {
        if ($this->players->count() == 0) {
            $this->activePlayer = $player;
        }

        $this->players->add($player);
    }
}
