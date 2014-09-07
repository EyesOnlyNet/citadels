$(function() {
    ko.applyBindings(myPlayerModel, document.getElementById('my-player'));
    ko.applyBindings(characterListModel, document.getElementById('character-list'));
    ko.applyBindings(playerListModel, document.getElementById('player-list'));

    game.refreshBoard();

    $('.action-refresh').click(function() {
        game.refreshBoard();
    });

    $('.action-end-turn').click(function() {
        var url = $(this).data('url'),
            redirectUrl = $('#app').data('url.game-results'),
            gameId = $('#app').data('game.id');

        $.ajax({
            url: url + gameId
        })
        .done(function(response) {
            var data = $.parseJSON(response);
            console.log("end-turn success");
            console.log(data);

            if (data.gameState === 2) {
                window.location.href = redirectUrl + gameId;
            }
        })
        .fail(function() { console.log("end-turn error"); })
        .always(function() { console.log("end-turn complete"); });
    });

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
