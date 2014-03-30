<?php

namespace Citadels\CoreBundle\Document;

use Citadels\CoreBundle\Document\Player;
use Citadels\CoreBundle\Traits\UuidTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class Game extends Base
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

    function __construct()
    {
        parent::__construct();

        $this->id = $this->getUuidV4(4);
        $this->players = new ArrayCollection();
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
     * @param Player $player
     */
    public function addPlayer(Player $player)
    {
        if ($this->players->count() == 0) {
            $this->activePlayer = $player;
        }

        $this->players->add($player);
    }

    /**
     * @param string $id
     * @return Player
     */
    public function getPlayerById($id)
    {
        /* @var $player Player */
        foreach ($this->getPlayers() as $player) {
            if ($player->getId() === $id) {
                return $player;
            }
        }

        return;
    }
}
