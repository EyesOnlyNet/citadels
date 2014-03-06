<?php

namespace Citadels\CoreBundle\Models\Card;

use Doctrine\Common\Collections\ArrayCollection;

class BuildingCardCollection extends ArrayCollection
{
    /**
     * @return int
     */
    public function getPoints()
    {
        $callback = function($current, BuildingCard $card) {
            return $current + $card->points;
        };

        return array_reduce($this->toArray(), $callback, 0);
    }
}
