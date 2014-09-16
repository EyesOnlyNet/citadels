var myPlayer = {
    model: ko.mapping.fromJS({
        id: '',
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
    }),
    rootUrl: $('#app').data('url.root') + 'players/',
    update: function(callback) {
        var fingerprint = new Fingerprint().get(),
            gameId = $('#app').data('game.id'),
            rootUrl = myPlayer.rootUrl;

        $.getJSON(
            rootUrl + fingerprint + '/game/' + gameId,
            function(response) {
                console.log("updateMyPlayer success");
                console.log(response);

                ko.mapping.fromJS(response.model, myPlayer.model);

                if (typeof callback === 'function') callback(response);
            }
        );
    },
    addGold: function() {
        var fingerprint = new Fingerprint().get(),
            gameId = $('#app').data('game.id');

        $.ajax(myPlayer.rootUrl + fingerprint + '/game/' + gameId + '/add-gold');
    },
    setName: function(data, callback) {
        var fingerprint = new Fingerprint().get();

        $.ajax({
            url: myPlayer.rootUrl + fingerprint + '/name',
            data: data,
            method: 'post'
        })
        .done(function(response) {
            if (typeof callback === 'function') callback(response);
        });
    }
};
