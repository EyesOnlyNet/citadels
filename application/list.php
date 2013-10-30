<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../application/styles/css/main.css" type="text/css" />
        <link rel="stylesheet" href="../application/styles/css/list.css" type="text/css" />
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
            <?php include './views/partials/characters.php'; ?>

            <div class="box create-game">
                <h4 class="header">Land annektieren</h4>
                <p class="content">
                    Beanspruchen Sie ein neues Stück Land und behaupten Sie sich gegen Ihre Widersacher.
                    <button>Grundstein legen</button>
                </p>
            </div>

            <div class="box game-pending">
                <h4 class="header">Grundstein gelegt</h4>
                <ul class="content">
                    <li>
                        <h5>Land #1</h5>
                        <ul class="list">
                            <li>Spieler #1</li>
                            <li>Spieler #2</li>
                            <li>Spieler #3</li>
                        </ul>
                        <button>hier bauen</button>
                    </li>

                    <li>
                        <h5>Land #2</h5>
                        <ul class="list">
                            <li>Spieler #4</li>
                            <li>Spieler #5</li>
                            <li>Spieler #6</li>
                        </ul>
                        <button>hier bauen</button>
                    </li>
                </ul>
            </div>

            <div class="box game-in-progress">
                <h4 class="header">hier bauen Sie gerade</h4>
                <ul class="content">
                    <li>
                        <h5>Land #3</h5>
                        <ul class="list">
                            <li>Spieler #7</li>
                            <li>Spieler #8</li>
                            <li>Spieler #9</li>
                        </ul>
                        <button>weiterbauen</button>
                    </li>

                    <li>
                        <h5>Land #4</h5>
                        <ul class="list">
                            <li>Spieler #10</li>
                            <li>Spieler #11</li>
                            <li>Spieler #12</li>
                        </ul>
                        <button>weiterbauen</button>
                    </li>
                </ul>
            </div>
        </div>

        <div class="site-footer">
            <hr />
            <footer>
                <ul>
                    <li><a href="http://www.brettspielwelt.de/Hilfe/Anleitungen/OhneFurchtUndAdel/" target="_blank">How To</a></li>
                    <li><a href="http://de.wikipedia.org/wiki/Ohne_Furcht_und_Adel" target="_blank">Wikipedia</a></li>
                    <li>Version: dev-20131027</li>
                </ul>
            </footer>
        </div>
    </body>
</html>
