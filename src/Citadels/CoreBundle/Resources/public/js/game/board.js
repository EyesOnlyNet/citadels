$(function() {
    var rootUrl = $('#app').data('url.root'),
        gameId = $('#app').data('game.id');

    ko.applyBindings(myPlayer.model, document.getElementById('my-player'));
    ko.applyBindings(characterListModel, document.getElementById('character-list'));
    ko.applyBindings(playerListModel, document.getElementById('player-list'));

    myPlayer.update(function() {
        if (myPlayer.model.name === '') {
            console.log('player-name empty');

            $('#modal').modal({
                remote: rootUrl + 'modal/player-name/',
                backdrop: 'static',
                keyboard: false
            });
        }
    });
    characterListModel.update();
    playerListModel.update();

    $('#modal').on('submit', 'form', function() {
        var data = $(this).serialize() + '&' + $.param({gameId: gameId});

        myPlayer.setName(data, myPlayer.update);
    });

    $('#modal').on('click', '.save-random-name-button', function() {
        var data = $.param({gameId: gameId});

        myPlayer.setName(data, myPlayer.update);
    });

    $('.action-refresh').click(function() {
        game.refreshBoard();
    });

    $('.action-end-turn').click(function() {
        game.endTurn(function() {
            playerListModel.update(function() {
                var activePlayerExist = false;

                $(playerListModel.playerList()).each(function() {
                    console.log(this.isActive());
                    activePlayerExist = activePlayerExist || this.isActive();
                });

                if (!activePlayerExist) {
                    window.location.href = rootUrl + 'game/' + gameId + '/results';
                }
            });
        });
    });

    $('.action-add-gold').click(function() {
        myPlayer.addGold();
        game.refreshBoard();
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
