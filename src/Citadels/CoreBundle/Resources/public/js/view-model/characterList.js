var characterListModel = ko.mapping.fromJS({
    characterList: [],
    update: function() {
        var gameId = $('#my-game').data('id');

        $.ajax({
            url: '/app_dev.php/characters/game/' + gameId
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
