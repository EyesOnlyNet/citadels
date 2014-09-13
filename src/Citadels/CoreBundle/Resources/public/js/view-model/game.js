var game = {
    refreshBoard: function() {
        myPlayerModel.update();
        characterListModel.update();
        playerListModel.update();
    },
    endTurn: function(callback) {
        var rootUrl = $('#app').data('url.root'),
            gameId = $('#app').data('game.id');

        $.getJSON(
            rootUrl + 'game/' + gameId + '/end-turn',
            function(response) {
                console.log("end-turn success");
                console.log(response);

                if (typeof callback === 'function') callback(response);
            }
        );
    }
};
