$(function() {
    var updatePlayerList = function() {
        var gameId = $('#my-game').data('id');

        $.ajax({
            url: '/app_dev.php/players/game/' + gameId
        })
        .done(function(response) {
            console.log("updatePlayerList success");
            console.log($.parseJSON(response));

            var data = { players: $.parseJSON(response).playerList };

            updateViewModel(data, viewModel);
        })
        .fail(function() { console.log("updatePlayerList error"); })
        .always(function() { console.log("updatePlayerList complete"); });
    };

    updatePlayerList();
});
