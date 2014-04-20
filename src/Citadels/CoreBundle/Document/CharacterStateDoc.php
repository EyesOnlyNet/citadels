<?php

namespace Citadels\CoreBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\EmbeddedDocument
 */
class CharacterStateDoc extends BaseDoc
{
    /**
     * @MongoDb\EmbedOne(targetDocument="CharacterCardDoc")
     * @var CharacterCardDoc
     */
    private $characterCard;

    /**
     * @MongoDB\String
     * @var string
     */
    private $state;

    /**
     * @param CharacterCardDoc $characterCard
     * @param string $state
     */
    public function __construct(CharacterCardDoc $characterCard, $state)
    {
        parent::__construct();

        $this->characterCard = $characterCard;
        $this->state = $state;
    }

    /**
     * @return CharacterCardDoc
     */
    public function getCharacterCard()
    {
        return $this->characterCard;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }
}
