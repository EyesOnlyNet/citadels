var characterListModel = ko.mapping.fromJS({
    characterList: [],
    update: function() {
        var gameId = $('#app').data('game.id'),
            rootUrl = $('#app').data('url.root');

        $.ajax({
            url: rootUrl + 'characters/game/' + gameId
        })
        .done(function(response) {
            console.log("updateCharacterList success");
            console.log($.parseJSON(response));

            ko.mapping.fromJS($.parseJSON(response), characterListModel);
        })
        .fail(function() { console.log("updateCharacterList error"); })
        .always(function() { console.log("updateCharacterList complete"); });
    }
});
