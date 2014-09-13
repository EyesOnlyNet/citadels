var playerListModel = ko.mapping.fromJS({
    playerList: [],
    update: function(callback) {
        var gameId = $('#app').data('game.id'),
            rootUrl = $('#app').data('url.root');

        $.getJSON(
            rootUrl + 'players/game/' + gameId,
            function(response) {
                console.log("updatePlayerList success");
                console.log(response);

                ko.mapping.fromJS({ playerlist: [] }, playerListModel);
                ko.mapping.fromJS(response, playerListModel);

                if (typeof callback === 'function') callback(response);
            }
        );
    }
});
