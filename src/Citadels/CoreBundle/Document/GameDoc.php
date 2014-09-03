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
    const STATE_NEW = 0;
    const STATE_START = 1;
    const STATE_END = 2;

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

    /**
     * @MongoDB\Int
     * @var int
     */
    private $state;

    public function __construct()
    {
        parent::__construct();

        $this->id = $this->getUuidV4(4);
        $this->players = new ArrayCollection();
        $this->characterStates = new ArrayCollection();
        $this->state = self::STATE_NEW;
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
     * @return int
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param PlayerDoc $player
     */
    public function addPlayer(PlayerDoc $player)
    {
        if ($this->players->count() == 0) {
            $this->activePlayer = $player;
            $this->state = self::STATE_START;
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

    public function nextTurn()
    {
        $this->nextPlayer();

        if ($this->activePlayerIsWinner()) {
            $this->endGame();
        }
    }

    private function nextPlayer()
    {
        $nextIndex = $this->players->indexOf($this->activePlayer) + 1;

        $this->activePlayer = $this->players->containsKey($nextIndex)
            ? $this->players->get($nextIndex)
            : $this->players->first();
    }

    /**
     * @return bool
     */
    private function activePlayerIsWinner()
    {
        return true;
//        return $this->winnerCriteriaChain->checkPlayer($this->activePlayer);
    }

    private function endGame()
    {
        $this->state = self::STATE_END;
        $this->activePlayer = null;
    }
}
