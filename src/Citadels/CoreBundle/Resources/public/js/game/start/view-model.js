var viewModel = ko.mapping.fromJS({
    myPlayer: {
        name: '-',
        gold: 0,
        buildings: [],
        handCards: [],
        points: 0,
        isActive: false,
        isKing: false,
        character: {
            type: 'neutral',
            name: '-',
            shortcut: 'ntr'
        }
    },
    players: [
        {
            name: '-',
            gold: 0,
            buildings: [],
            handCards: [],
            points: 0,
            isActive: false,
            isKing: false,
            character: {
                type: 'neutral',
                name: '-',
                shortcut: 'ntr'
            }
        }
    ]
});

$(function() {
    updateViewModel = function(data, viewModel){
        ko.mapping.fromJS(data, viewModel);
    };

    ko.applyBindings(viewModel);
});
