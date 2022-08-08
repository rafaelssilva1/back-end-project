<ul class="genres__list">
    <?php
        foreach ($genres as $genre) {
            ?>
                <li class="genres__item">
                    <form method="GET" action="/search/">
                        <button type="submit"
                            id="<?php
                                if(isset($_GET["genres"])) {
                                    if($genre["id"] == $_GET["genres"]) {
                                        echo "genres__item--active";
                                    }
                                }
                            ?>"
                            name="genres" value="<?php echo $genre["id"]; ?>" class="genres__text"><?php echo $genre["name"]; ?></button>
                    </form>
                </li>
            <?php
        }
    ?>
</ul>