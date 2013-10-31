<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../application/styles/css/main.css" type="text/css" />
        <link rel="stylesheet" href="../application/styles/css/index.css" type="text/css" />
        <title>Citadels - the Webversion</title>
    </head>

    <body>
        <div class="site-header">
            <header>
                <h1>Ohne Furcht und Adel</h1>
                <h2>- Webversion -</h2>
            </header>
            <hr />
        </div>

        <div class="site-content">
            <form class="welcome" action="check-name.php" method="post">
                <label>Willkommen Besucher, wie ist dein Name:</label>
                <input name="user-name" placeholder="Großherzog Augustus Mediacus" />
                <button value="check">Landkarte einsehen</button>
            </form>
        </div>

        <div class="site-footer">
            <?php include './views/partials/footer.php'; ?>
        </div>
    </body>
</html>
