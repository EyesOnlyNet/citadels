$(function() {
    ko.applyBindings(playerListModel, document.getElementById('player-list'));

    playerListModel.update();
});
