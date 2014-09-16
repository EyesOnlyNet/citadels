var modal = {
    rootUrl: $('#app').data('url.root') + 'modal/',
    playerName: function() {
        $('#modal').modal({
            remote: modal.rootUrl + 'player-name/',
            backdrop: 'static',
            keyboard: false
        });
    }
};
