<?php
namespace Citadels\CoreBundle\Models\ViewModel\Mapper;

use Citadels\CoreBundle\DependencyInjection\Service\CharacterCardService;
use Citadels\CoreBundle\Document\CharacterCardDoc;
use Citadels\CoreBundle\Models\ViewModel\CharacterCardView;
use Doctrine\Common\Collections\Collection;

class CharacterCardMapper
{
    /**
     * @var CharacterCardService
     */
    private $characterCardService;

    /**
     * @param CharacterCardService $characterCardService
     */
    public function __construct(CharacterCardService $characterCardService)
    {
        $this->characterCardService = $characterCardService;
    }

    /**
     * @param CharacterCardDoc $characterCard
     * @return CharacterCardView
     */
    public function map(CharacterCardDoc $characterCard)
    {
        $characterCardView = new CharacterCardView();
        $characterCardView->type = $characterCard->getType();
        $characterCardView->name = $this->characterCardService->getName($characterCard);
        $characterView->shortcut = $this->characterCardService->getShortcut($characterCard));

        return $characterCardView;
    }

    /**
     * @param Collection $characterCards
     * @return Collection
     */
    public function mapCollection(Collection $characterCards)
    {
        $closure = function(CharacterCardDoc $characterCard) {
            return $this->map($characterCard);
        };

        return $characterCards->map($closure);
    }
}
