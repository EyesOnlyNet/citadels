$(function() {
    var updateMyPlayer = function() {
        var fingerprint = new Fingerprint().get(),
            gameId = $('#my-game').data('id');

        $.ajax({
            url: '/app_dev.php/players/' + fingerprint + '/game/' + gameId
        })
        .done(function(response) {
            console.log("updateMyPlayer success");
            console.log($.parseJSON(response));

            var data = { myPlayer: $.parseJSON(response).myPlayer };

            updateViewModel(data, viewModel);
        })
        .fail(function() { console.log("updateMyPlayer error"); })
        .always(function() { console.log("updateMyPlayer complete"); });
    };

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

    updateMyPlayer();
    updatePlayerList();

    $('#action-tabs').tabs({
        disabled: [],
        activate: function() {
            scrollTo('#action-tabs');
        },
        fx: {
            height: 'toggle',
            opacity: 'toggle'
        }
    });

    $('.show-tab').click(function() {
        $('#action-tabs').tabs('select', this.hash);

        return false;
    });

    function scrollTo(element) {
        $('html, body').animate({
            scrollTop: $(element).offset().top
        }, 'slow');
    }

    $('#tab-end button').click(function() {
        var href = $(this).data('href'),
            redirect = $(this).data('redirect'),
            gameId = $('#my-game').data('id');;

        $.ajax({
            url: href + gameId
        })
        .done(function(response) {
            var data = $.parseJSON(response);
            console.log("end-turn success");
            console.log(data);

            if (data.gameState === 2) {
                window.location.href = redirect + gameId;
            }
        })
        .fail(function() { console.log("end-turn error"); })
        .always(function() { console.log("end-turn complete"); });
    });
});
