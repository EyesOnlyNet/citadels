$(function() {
    var identifyGuest = function() {
        var fingerprint = new Fingerprint().get();

        $.ajax({
            url: '/app_dev.php/dirty/test/' + fingerprint
        })
        .done(function() { alert("success"); })
        .fail(function() { alert("error"); })
        .always(function() { alert("complete"); });
    };

    identifyGuest();

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
