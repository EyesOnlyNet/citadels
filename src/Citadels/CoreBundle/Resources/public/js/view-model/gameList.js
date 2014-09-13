var gameListModel = ko.mapping.fromJS({
    gameList: [],
    update: function() {
        var rootUrl = $('#app').data('url.root'),
            fingerprint = new Fingerprint().get();

        $.getJSON(
            rootUrl + 'game/player/' + fingerprint,
            function(response) {
                console.log("updateGameList success");
                console.log(response);

                ko.mapping.fromJS({}, gameListModel);
                ko.mapping.fromJS(response, gameListModel);
            }
        );
    }
});
