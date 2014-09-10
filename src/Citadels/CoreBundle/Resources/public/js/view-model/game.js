var game = {
    refreshBoard: function() {
        myPlayerModel.update();
        characterListModel.update();
        playerListModel.update();
    },
    endTurn: function(callback) {
        var rootUrl = $('#app').data('url.root'),
            gameId = $('#app').data('game.id');

        $.ajax({
            url: rootUrl + 'game/' + gameId + '/end-turn'
        })
        .done(function(response) {
            console.log("end-turn success");
            console.log($.parseJSON(response));

            if (typeof callback === 'function') callback();
        })
        .fail(function() { console.log("end-turn error"); })
        .always(function() { console.log("end-turn complete"); });
    }
};
