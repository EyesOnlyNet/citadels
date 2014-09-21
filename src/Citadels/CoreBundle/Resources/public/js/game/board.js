$(function() {
    var rootUrl = $('#app').data('url.root'),
        gameId = $('#app').data('game.id');

    ko.applyBindings(myPlayer.model, document.getElementById('my-player'));
    ko.applyBindings(characterListModel, document.getElementById('character-list'));
    ko.applyBindings(playerListModel, document.getElementById('player-list'));

    myPlayer.update(function() {
        if (myPlayer.model.id() === '') {
            console.log('can not load player');
            myPlayer.create(modal.playerName);
        }

        if (myPlayer.model.name() === '') {
            console.log('player-name empty');
            modal.playerName();
        }
    });
    characterListModel.update();
    playerListModel.update();

    $('#modal').on('submit', 'form', function() {
        var data = $(this).serialize() + '&' + $.param({gameId: gameId});

        myPlayer.setName(data);
    });

    $('#modal').on('click', '.save-random-name-button', function() {
        var data = $.param({gameId: gameId});

        myPlayer.setName(data);
    });

    $('.actions .btn').popover({
        container: 'body',
        trigger: 'hover',
        placement: 'top',
        html: true
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
    });
});
