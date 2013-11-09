<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="/styles/css/main.css" type="text/css" />
        <link rel="stylesheet" href="/styles/css/list.css" type="text/css" />
        <title>Citadels - game list</title>
    </head>

    <body>
        <div class="site-header">
            <header>
                <h1>Willkommen [Spielername]</h1>
                <h2>- Spielliste -</h2>
            </header>
            <hr />
        </div>

        <div class="site-content">
            <?php include './views/partials/boxes/create-game.php'; ?>
            <?php include './views/partials/boxes/games-pending.php'; ?>
            <?php include './views/partials/boxes/games-in-progress.php'; ?>
        </div>

        <div class="site-footer">
            <?php include './views/partials/footer.php'; ?>
        </div>
    </body>
</html>
