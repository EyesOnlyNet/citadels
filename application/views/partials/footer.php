<hr />
<footer>
    <ul>
        <li><a href="http://www.brettspielwelt.de/Hilfe/Anleitungen/OhneFurchtUndAdel/" target="_blank">How To</a></li>
        <li><a href="http://de.wikipedia.org/wiki/Ohne_Furcht_und_Adel" target="_blank">Wikipedia</a></li>
        <li>Version: dev-20131108</li>

        <?php
            foreach (glob('*.*') as $file) {
                if(is_file($file)) {
                    echo sprintf('<li><a href="%1$s">%1$s</a></li>', $file);
                }
            }
        ?>
    </ul>
</footer>
