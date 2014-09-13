var myPlayerModel = ko.mapping.fromJS({
    myPlayer: {
        name: '',
        gold: 0,
        buildings: [],
        handCards: [],
        points: 0,
        isActive: false,
        isKing: false,
        character: {
            type: '',
            name: '',
            shortcut: ''
        }
    },
    update: function(callback) {
        var fingerprint = new Fingerprint().get(),
            gameId = $('#app').data('game.id');

        $.getJSON(
            '/app_dev.php/players/' + fingerprint + '/game/' + gameId,
            function(response) {
                console.log("updateMyPlayer success");
                console.log(response);

                ko.mapping.fromJS(response, myPlayerModel);

                if (typeof callback === 'function') callback(response);
            }
        );
    },
    addGold: function() {
        var fingerprint = new Fingerprint().get(),
            gameId = $('#app').data('game.id');

        $.getJSON(
            '/app_dev.php/players/' + fingerprint + '/game/' + gameId + '/add-gold',
            function(response) {
                console.log("addGold success");
                console.log(response);
            }
        );
    }
});
