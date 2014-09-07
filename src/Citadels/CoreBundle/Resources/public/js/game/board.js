$(function() {
    ko.applyBindings(myPlayerModel, document.getElementById('my-player'));
    ko.applyBindings(characterListModel, document.getElementById('character-list'));
    ko.applyBindings(playerListModel, document.getElementById('player-list'));

    game.refreshBoard();

    $('.action-refresh').click(function() {
        game.refreshBoard();
    });

    $('.action-end-turn').click(function() {
        game.endTurn();
    });

    $('.action-get-gold').click(function() {
        myPlayerModel.getGold();
        myPlayerModel.update();
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
