$(function() {
    ko.applyBindings(playerListModel, document.getElementById('player-list'));
    ko.applyBindings(myPlayerModel, document.getElementById('my-player'));

    playerListModel.update();
    myPlayerModel.update();

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
