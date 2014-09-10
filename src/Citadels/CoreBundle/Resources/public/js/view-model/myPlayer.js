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
    update: function() {
        var fingerprint = new Fingerprint().get(),
            gameId = $('#app').data('game.id');

        $.ajax({
            url: '/app_dev.php/players/' + fingerprint + '/game/' + gameId
        })
        .done(function(response) {
            console.log("updateMyPlayer success");
            console.log($.parseJSON(response));

            ko.mapping.fromJS($.parseJSON(response), myPlayerModel);
        })
        .fail(function() { console.log("updateMyPlayer error"); })
        .always(function() { console.log("updateMyPlayer complete"); });
    },
    addGold: function() {
        var fingerprint = new Fingerprint().get(),
            gameId = $('#app').data('game.id');

        $.ajax({
            url: '/app_dev.php/players/' + fingerprint + '/game/' + gameId + '/add-gold'
        })
        .done(function(response) {
            console.log("addGold success");
            console.log($.parseJSON(response));
        })
        .fail(function() { console.log("addGold error"); })
        .always(function() { console.log("addGold complete"); });
    }
});
