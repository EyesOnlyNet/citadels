$(function() {
    ko.applyBindings(gameListModel, document.getElementById('game-list'));

    $('input[name="fingerprint"]').attr('value', new Fingerprint().get());
    
    gameListModel.update();
});
