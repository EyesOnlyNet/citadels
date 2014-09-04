<?php
namespace Citadels\CoreBundle\Models\ViewModel\Mapper;

use Citadels\CoreBundle\Document\CharacterCardDoc;
use Citadels\CoreBundle\Document\GameDoc;
use Citadels\CoreBundle\Models\ViewModel\CharacterView;
use Doctrine\Common\Collections\ArrayCollection;

class CharacterListMapper
{
    /**
     * @param GameDoc $game
     * @return ArrayCollection
     */
    public static function createFromGameDoc(GameDoc $game)
    {
        $characterListView = new ArrayCollection([new CharacterView()]);

        return $characterListView;
    }

    /**
     * @param ArrayCollection $list
     * @return CharacterView
     */
    public static function createFromCharacterList(ArrayCollection $list)
    {
        $characterListView = new ArrayCollection();

        /* @var $characterDoc CharacterCardDoc */
        foreach ($list as $characterDoc) {
            $character = new CharacterView();
            $character->name = $characterDoc->getName();
            $character->shortcut = $characterDoc->getShortcut();
            $character->type = $characterDoc->getType();

            $characterListView[] = $character;
        }

        return $characterListView;
    }
}
