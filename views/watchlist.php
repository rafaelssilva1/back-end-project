<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Watchlist</title>
</head>
<body>
    <?php include("views/header.php"); ?>

    <div class="container watchlist padding-bottom">
        <h1 class="watchlist__title">Howdy, <?php if(isset($userPayload["username"])) { echo $userPayload["username"]; } else { echo "stranger"; } ?>!</h1>
        <?php
            if(!empty($watchlist)) {
                ?>
                    <h2 class="watchlist__title">This is your watchlist:</h2>
                <?php
            }
        ?>
            <?php
                if(!empty($watchlist)) {
                    ?>
                    <div class="movie__grid">
                        <?php
                            foreach ($watchlist as $key => $value) {
                                echo('
                                    <article class="movie__article">
                                        <a href="/movies/'.$watchlist[$key]["id"].'">
                                            <div class="movie__link">
                                                <picture class="movie__picture">
                                                    <img class="movie__image" src="/uploads/poster_path/'. $watchlist[$key]["poster_path"] .'">
                                                </picture>
                                                <div class="movie__info">
                                                    <h2 class="movie__title">'.$watchlist[$key]["title"].'</h2>
                                                    <div class="movie__truncate">
                                                        <p class="movie__description">'.$watchlist[$key]["overview"].'</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </article>
                                ');
                            }
                        ?>
                    </div>
                    <?php
                } else {
                    ?>
                        <div class="watchlist__notfound">
                            <h2>Here you can save any movie you want to see later!</h2>
                            <h3>(you must be logged in to do it)</h3>
                            <a href="/movies">
                                <button class="button">Explore movies</button>
                            </a>
                        </div>
                    <?php
                }
            ?>
    </div>
    
    <?php include("views/footer.php"); ?>
</body>
</html>