<?php
namespace Citadels\CoreBundle\Models\ViewModel\Mapper;

use Citadels\CoreBundle\Document\GameDoc;
use Citadels\CoreBundle\Models\ViewModel\CharacterCardView;
use Doctrine\Common\Collections\ArrayCollection;

class CharacterListMapper
{
    /**
     * @param GameDoc $game
     * @return ArrayCollection
     */
    public static function createFromGameDoc(GameDoc $game)
    {
        $characterListView = new ArrayCollection([new CharacterCardView()]);

        return $characterListView;
    }
}
