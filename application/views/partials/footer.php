<link rel="stylesheet" href="../application/styles/css/partials/footer.css" type="text/css" />

<?php
    $times = [];

    foreach (glob('*.*') as $file) {
        if(is_file($file))
        {
            $times[] = filemtime($file);
        }

    }

    sort($times);
?>

<hr />
<footer>
    <ul>
        <li><a href="http://www.brettspielwelt.de/Hilfe/Anleitungen/OhneFurchtUndAdel/" target="_blank">How To</a></li>
        <li><a href="http://de.wikipedia.org/wiki/Ohne_Furcht_und_Adel" target="_blank">Wikipedia</a></li>
        <li>Version: dev-<?= date('Ymd', reset($times)) ?></li>
    </ul>
</footer>
