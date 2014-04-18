<?php
namespace Citadels\CoreBundle\Models\ViewModel\Mapper;

use Citadels\CoreBundle\Document\CharacterCardDoc;
use Citadels\CoreBundle\Models\ViewModel\CharacterView;

class CharacterMapper
{
    /**
     * @param CharacterCardDoc $characterCard
     * @return CharacterView
     */
    public static function createFromCharacterCardDoc(CharacterCardDoc $characterCard)
    {
        $characterView = new CharacterView();
        $characterView->name = $characterCard->getName();
        $characterView->shortcut = $characterCard->getShortcut();
        $characterView->type = $characterCard->getType();

        return $characterView;
    }
}
