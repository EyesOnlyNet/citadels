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
    getGold: function() {
        var fingerprint = new Fingerprint().get(),
            gameId = $('#app').data('game.id');

        $.ajax({
            url: '/app_dev.php/players/' + fingerprint + '/game/' + gameId + '/get-gold'
        })
        .done(function(response) {
            console.log("getGold success");
            console.log($.parseJSON(response));
        })
        .fail(function() { console.log("getGold error"); })
        .always(function() { console.log("getGold complete"); });
    }
});
