<?php

namespace Citadels\CoreBundle\Document;

use Citadels\CoreBundle\Document\PlayerDoc;
use Citadels\CoreBundle\Traits\UuidTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document(collection="game")
 */
class GameDoc extends BaseDoc
{
    use UuidTrait;

    /**
     * @MongoDB\Id(strategy="UUID")
     * @var string
     */
    private $id;

    /**
     * @MongoDb\EmbedMany(targetDocument="PlayerDoc")
     * @var ArrayCollection
     */
    private $players;

    /**
     * @MongoDb\EmbedOne(targetDocument="PlayerDoc")
     * @var PlayerDoc
     */
    private $activePlayer;

    /**
     * @MongoDb\EmbedMany(targetDocument="CharacterStateDoc")
     * @var ArrayCollection
     */
    private $characterStates;

    public function __construct()
    {
        parent::__construct();

        $this->id = $this->getUuidV4(4);
        $this->players = new ArrayCollection();
        $this->characterStates = new ArrayCollection();
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
     * @return PlayerDoc
     */
    public function getActivePlayer()
    {
        return $this->activePlayer;
    }

    /**
     * @param PlayerDoc $player
     */
    public function addPlayer(PlayerDoc $player)
    {
        if ($this->players->count() == 0) {
            $this->activePlayer = $player;
        }

        $this->players->add($player);
    }

    /**
     * @param string $id
     * @return PlayerDoc
     */
    public function getPlayerById($id)
    {
        /* @var $player PlayerDoc */
        foreach ($this->getPlayers() as $player) {
            if ($player->getId() === $id) {
                return $player;
            }
        }

        return;
    }
}
