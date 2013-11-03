<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../application/styles/css/main.css" type="text/css" />
        <link rel="stylesheet" href="../application/styles/css/field.css" type="text/css" />
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
        </div>

        <div class="site-footer">
            <?php include './views/partials/footer.php'; ?>
        </div>
    </body>
</html>
