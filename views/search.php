<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Movie List</title>
</head>
<body>
    <?php include("views/header.php"); ?>

    <div class="container">
        <?php
            if(empty($moviesByGenre)) {
                ?>
                    <h2 class="genres__title"><?php if(isset($_SESSION["message"])) { echo $_SESSION["message"]; } ?></h2>
                <?php
            } else {
                ?>
                    <h1 class="genres__title">Search a movie in any genre!</h1>

                    <?php if(isset($_GET["genres"])) { require("views/genres.php"); } ?>
                    
                    <div class="movie__grid">
                        <?php
                            foreach ($moviesByGenre as $key => $value) {
                                echo ('
                                    <article class="movie__article" data-movie="'. $moviesByGenre[$key]["id"] .'" >
                                        <a href="/movies/'. $moviesByGenre[$key]["id"] .'">
                                            <div class="movie__link">
                                                <picture class="movie__picture">
                                                    <img class="movie__image" src="https://image.tmdb.org/t/p/w342'. $moviesByGenre[$key]["poster_path"] .'" />        
                                                </picture>
                                                <div class="movie__info">
                                                    <h2 class="movie__title">'. $moviesByGenre[$key]["title"] .'</h2>
                                                    <div class="movie__vote">
                                                        <span>'. $moviesByGenre[$key]["vote_avg"]  .'</span>
                                                        <span class="material-symbols-outlined">
                                                            star
                                                        </span>
                                                    </div>
                                                    <div class="movie__truncate">
                                                        <p class="movie__description">'. $moviesByGenre[$key]["overview"] .'</p>
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
            }
        ?>
    </div>

    <div class="container button_div">
        <?php
            if(isset($_GET["page"])) {
                if(!$disablePrevious and !($_GET["page"] <= 1)) {
                    ?>
                        <form class="genres__button" method="GET" action="/search/"> 
                            <input type="hidden" name="genres" value="<?php echo $_GET["genres"] ?>">
                            <input type="hidden" name="page" value="<?php if(isset($_GET["page"])) { echo $_GET["page"] - 1; } ?>">
                            <input type="submit" value="Previous Page" class="button">
                        </form>
                    <?php
                }
            }
        ?>

        <?php
            if(!empty($moviesByGenre)) {
                if($moviesCount["count"] > 12) {
                    if(!$disableNext) {
                        ?>
                            <form class="genres__button" method="GET" action="/search/">
                                <input type="hidden" name="genres" value="<?php echo $_GET["genres"] ?>">
                                <input type="hidden" name="page" value="<?php echo $page ?>">
                                <input type="submit" value="Next Page" class="button">
                            </form>
                        <?php
                    }
                }
            }
        ?>
    </div>
    
    <?php include("views/footer.php"); ?>
</body>
</html>