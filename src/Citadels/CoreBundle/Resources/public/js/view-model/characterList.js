var characterListModel = ko.mapping.fromJS({
    characterList: [],
    update: function() {
        var gameId = $('#app').data('game.id'),
            rootUrl = $('#app').data('url.root');

        $.getJSON(
            rootUrl + 'characters/game/' + gameId,
            function(response) {
                console.log("updateCharacterList success");
                console.log(response);

                ko.mapping.fromJS({}, characterListModel);
                ko.mapping.fromJS(response, characterListModel);
            }
        );
    }
});
