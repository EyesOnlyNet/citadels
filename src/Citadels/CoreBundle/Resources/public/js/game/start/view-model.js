var viewModel = ko.mapping.fromJS({
    myPlayer: {
        name: '-',
        gold: 0,
        buildings: [],
        handCards: [],
        points: 0,
        isKing: false,
        character: {
            type: '',
            name: ''
        }
    }
});

$(function() {
    updateViewModel = function(data, viewModel){
        ko.mapping.fromJS(data, viewModel);
    };

    ko.applyBindings(viewModel);
});
