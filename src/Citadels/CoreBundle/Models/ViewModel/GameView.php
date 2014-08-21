<?php
namespace Citadels\CoreBundle\Models\ViewModel;

use JMS\SerializerBundle\Annotation as Jms;

class GameView
{
    private $id;
    private $playerList;
    private $characterCardList;

    /**
     * @Jms\Type("boolean")
     * @Jms\SerializedName("isActive")
     */
    public $isActive = false;

    /**
     * @Jms\Type("boolean")
     * @Jms\SerializedName("isKing")
     */
    public $isKing = false;
    public $buildings = [];

    /**
     * @Jms\Type("array")
     * @Jms\SerializedName("handCards")
     */
    public $handCards = [];

    /**
     * @Jms\Type("Citadels\CoreBundle\Models\ViewModel\CharacterCardView")
     * @Jms\SerializedName("characterCard")
     * @var CharacterCardView
     */
    public $characterCard;
}
