$(function() {
    $('input[name="fingerprint"]').attr('value', new Fingerprint().get());
});
