$(function() {
    var identifyMe = function() {
        var fingerprint = new Fingerprint().get(),
            gameId = $('#my-game').data('id');

        $.ajax({
            url: '/app_dev.php/player/' + fingerprint + '/game/' + gameId
        })
        .done(function(response) {
            console.log("success");

            var data = { myPlayer: $.parseJSON(response) };

            updateViewModel(data, viewModel);
        })
        .fail(function() { console.log("error"); })
        .always(function() { console.log("complete"); });
    };

    identifyMe();

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
