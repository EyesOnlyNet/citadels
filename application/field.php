<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="/styles/css/main.css" type="text/css" />
        <link rel="stylesheet" href="/styles/css/field.css" type="text/css" />
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
        <title>Citadels - game field</title>
    </head>

    <body>
        <div class="site-header">
            <header>
                <ul>
                    <li>
                        <?php include './views/partials/player-compact.php'; ?>
                    </li>
                </ul>
            </header>
            <hr />
        </div>

        <div class="site-content">
            <?php include './views/partials/character-choice.php'; ?>
            <?php include './views/partials/player.php'; ?>

            <div id="action-tabs" class="tabs">
                <?php include './views/partials/tabs/actions.php'; ?>

                <div class="tab-body">
                    <?php include './views/partials/tabs/actions/draw-card.php'; ?>
                    <?php include './views/partials/tabs/actions/effect-draw-cards.php'; ?>
                    <?php include './views/partials/tabs/actions/effect-get-card-gold.php'; ?>
                    <?php include './views/partials/tabs/actions/effect-get-gold.php'; ?>
                    <?php include './views/partials/tabs/actions/effect-play-cards.php'; ?>
                    <?php include './views/partials/tabs/actions/effect-remove-card.php'; ?>
                    <?php include './views/partials/tabs/actions/effect-stall-character.php'; ?>
                    <?php include './views/partials/tabs/actions/effect-steal-gold.php'; ?>
                    <?php include './views/partials/tabs/actions/exchange-cards.php'; ?>
                    <?php include './views/partials/tabs/actions/get-gold.php'; ?>
                    <?php include './views/partials/tabs/actions/hand.php'; ?>
                    <?php include './views/partials/tabs/actions/play-card.php'; ?>
                </div>
            </div>
        </div>

        <script>
            $(function() {
                $("#action-tabs").tabs();
            });
        </script>

        <div class="site-footer">
            <?php include './views/partials/footer.php'; ?>
        </div>
    </body>
</html>
