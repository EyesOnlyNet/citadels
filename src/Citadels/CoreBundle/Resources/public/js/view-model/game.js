var game = {
    refreshBoard: function() {
        myPlayerModel.update();
        characterListModel.update();
        playerListModel.update();
    },
    endTurn: function() {
        var rootUrl = $('#app').data('url.root'),
            gameId = $('#app').data('game.id');

        $.ajax({
            url: rootUrl + 'game/' + gameId + '/end-turn'
        })
        .done(function(response) {
            var data = $.parseJSON(response);
            console.log("end-turn success");
            console.log(data);

            if (data.gameState === 2) {
                window.location.href = rootUrl + 'game/' + gameId + '/results';
            }
        })
        .fail(function() { console.log("end-turn error"); })
        .always(function() { console.log("end-turn complete"); });
    }
};
