var playerListModel = ko.mapping.fromJS({
    playerList: [],
    update: function(callback) {
        var gameId = $('#app').data('game.id'),
            rootUrl = $('#app').data('url.root');

        $.ajax({
            url: rootUrl + 'players/game/' + gameId
        })
        .done(function(response) {
            console.log("updatePlayerList success");
            console.log($.parseJSON(response));

            ko.mapping.fromJS({ playerlist: [] }, playerListModel);
            ko.mapping.fromJS($.parseJSON(response), playerListModel);

            if (typeof callback === 'function') callback();
        })
        .fail(function() { console.log("updatePlayerList error"); })
        .always(function() { console.log("updatePlayerList complete"); });
    }
});
