var viewModel = ko.mapping.fromJS({
    myPlayer: {
        name: '-',
        gold: 0,
        buildings: 0,
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
