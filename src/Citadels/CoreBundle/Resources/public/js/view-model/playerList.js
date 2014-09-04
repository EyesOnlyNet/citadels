var playerListModel = ko.mapping.fromJS({
    playerList: [],
    update: function() {
        var gameId = $('#my-game').data('id');

        $.ajax({
            url: '/app_dev.php/players/game/' + gameId
        })
        .done(function(response) {
            console.log("updatePlayerList success");
            console.log($.parseJSON(response));

            ko.mapping.fromJS($.parseJSON(response), playerListModel);
        })
        .fail(function() { console.log("updatePlayerList error"); })
        .always(function() { console.log("updatePlayerList complete"); });
    }
});
