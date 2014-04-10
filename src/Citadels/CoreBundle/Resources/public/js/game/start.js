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

    var updatePlayers = function() {
        var gameId = $('#my-game').data('id');

        $.ajax({
            url: '/app_dev.php/players/game/' + gameId
        })
        .done(function(response) {
            console.log("updatePlayers success");
            console.log($.parseJSON(response));

            var data = { players: $.parseJSON(response).players };

            updateViewModel(data, viewModel);
        })
        .fail(function() { console.log("updatePlayers error"); })
        .always(function() { console.log("updatePlayers complete"); });
    };

    updateMyPlayer();
    updatePlayers();

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
});
