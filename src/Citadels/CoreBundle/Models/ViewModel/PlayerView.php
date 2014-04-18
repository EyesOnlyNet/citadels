<?php
namespace Citadels\CoreBundle\Models\ViewModel;

use JMS\SerializerBundle\Annotation as Jms;

class PlayerView
{
    public $name = '-';
    public $gold = 0;
    public $points = 0;

    /**
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
     * @Jms\Type("Citadels\CoreBundle\Models\ViewModel\CharacterView")
     */
    public $character;
}
