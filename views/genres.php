<ul class="genres__list">
    <?php
        foreach ($genres as $genre) {
            echo "
                <li class='genres__item'>
                    <form method='GET' action='/search/'>
                        <button type='submit' id=".$genre["id"]." name='genres' value=".$genre["id"]." class='genres__text'>".$genre["name"]."</button>
                    </form>
                </li>
            ";
        }
    ?>
</ul>