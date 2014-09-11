var gameListModel = ko.mapping.fromJS({
    gameList: [],
    update: function() {
        var rootUrl = $('#app').data('url.root'),
            fingerprint = new Fingerprint().get();

        $.ajax({
            url: rootUrl + 'game/player/' + fingerprint
        })
        .done(function(response) {
            console.log("updateGameList success");
            console.log($.parseJSON(response));

            ko.mapping.fromJS({}, gameListModel);
            ko.mapping.fromJS($.parseJSON(response), gameListModel);
        })
        .fail(function() { console.log("updateGameList error"); })
        .always(function() { console.log("updateGameList complete"); });
    }
});
