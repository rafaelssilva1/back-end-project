<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Brutally Honest</title>
</head>
<body>
    <?php require("views/header.php") ?>

    <div class="heroContainer">
        <?php
            foreach ($heroMovies as $key => $value) {
                echo ('
                    <div class="hero" style="background:url(/uploads/backdrop_path/'.$heroMovies[$key]["backdrop_path"].'); background-position: center; background-repeat: no-repeat; background-size: cover;">
                        <div class="hero__text">
                            <h2 class="hero__title">'.$heroMovies[$key]["title"].'</h2>
                            <p class="hero__description">'.$heroMovies[$key]["overview"].'</p>
                            <a href="movies/'.$heroMovies[$key]["id"].'">
                                <button class="button hero__button">
                                    Watch Trailer
                                    <span class="material-icons-outlined">
                                        play_circle_filled
                                    </span>
                                </button>
                            </a>
                        </div>
                    </div>
                ');
            }
        ?>
        <button class="hero__slidebutton hero__slidebutton--left">
            <span class="material-icons-outlined hero__button_left">
                keyboard_arrow_left
            </span>
        </button>
        <button class="hero__slidebutton hero__slidebutton--right">
            <span class="material-icons-outlined hero__button_right">
                keyboard_arrow_right
            </span>
        </button>
    </div>

    <div class="container padding-bottom">
        <div class="movieslideshow__header">
                <h2>Popular</h2>
                <div class="movieslideshow__bar"></div>
        </div>
        <div class="movieslideshow">
            <div class="movieslideshow__grid">
                <?php
                    foreach ($popularMovies as $key => $value) {
                        echo ('
                            <article class="movieslideshow__article">
                                <a href="/movies/'.$popularMovies[$key]["id"].'">
                                    <div class="movie__link">
                                        <picture class="movie__picture">
                                            <img class="movie__image" src="/uploads/poster_path/'.$popularMovies[$key]["poster_path"].'" />
                                        </picture>
                                        <div class="movie__info">
                                            <h2 class="movie__title">'.$popularMovies[$key]["title"].'</h2>
                                            <div class="movie__vote">
                                                <span>'.$popularMovies[$key]["vote_avg"].'</span>
                                                <span class="material-icons-outlined">
                                                    star
                                                </span>
                                            </div>
                                            <div class="movie__truncate">
                                                <p class="movie__description">'.$popularMovies[$key]["overview"].'</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </article>
                        ');
                    }
                ?>
            </div>
            <button class="movieslideshow__slidebutton movieslideshow__slidebutton--left">
                <span class="material-icons-outlined">
                    keyboard_arrow_left
                </span>
            </button>
            <button class="movieslideshow__slidebutton movieslideshow__slidebutton--right">
                <span class="material-icons-outlined">
                    keyboard_arrow_right
                </span>
            </button>
        </div>
        <div class="movieslideshow__header">
                <h2>Top Rated</h2>
                <div class="movieslideshow__bar"></div>
        </div>
        <div class="movieslideshow">
            <div class="movieslideshow__grid">
                <?php
                    foreach ($topRatedMovies as $key => $value) {
                        echo ('
                            <article class="movieslideshow__article">
                                <a href="/movies/'.$topRatedMovies[$key]["id"].'">
                                    <div class="movie__link">
                                        <picture class="movie__picture">
                                            <img class="movie__image" src="/uploads/poster_path/'.$topRatedMovies[$key]["poster_path"].'" />
                                        </picture>
                                        <div class="movie__info">
                                            <h2 class="movie__title">'.$topRatedMovies[$key]["title"].'</h2>
                                            <div class="movie__vote">
                                                <span>'.$topRatedMovies[$key]["vote_avg"].'</span>
                                                <span class="material-icons-outlined">
                                                    star
                                                </span>
                                            </div>
                                            <div class="movie__truncate">
                                                <p class="movie__description">'.$topRatedMovies[$key]["overview"].'</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </article>
                        ');
                    }
                ?>
            </div>
            <button class="movieslideshow__slidebutton movieslideshow__slidebutton--left">
                <span class="material-icons-outlined">
                    keyboard_arrow_left
                </span>
            </button>
            <button class="movieslideshow__slidebutton movieslideshow__slidebutton--right">
                <span class="material-icons-outlined">
                    keyboard_arrow_right
                </span>
            </button>
        </div>
        <div class="movieslideshow__header">
                <h2>Upcoming</h2>
                <div class="movieslideshow__bar"></div>
        </div>
        <div class="movieslideshow">
            <div class="movieslideshow__grid">
                <?php
                    foreach ($upcomingMovies as $key => $value) {
                        echo ('
                            <article class="movieslideshow__article">
                                <a href="/movies/'.$upcomingMovies[$key]["id"].'">
                                    <div class="movie__link">
                                        <picture class="movie__picture">
                                            <img class="movie__image" src="/uploads/poster_path/'.$upcomingMovies[$key]["poster_path"].'" />
                                        </picture>
                                        <div class="movie__info">
                                            <h2 class="movie__title">'.$upcomingMovies[$key]["title"].'</h2>
                                            <div class="movie__vote">
                                                <span>'.$upcomingMovies[$key]["vote_avg"].'</span>
                                                <span class="material-icons-outlined">
                                                    star
                                                </span>
                                            </div>
                                            <div class="movie__truncate">
                                                <p class="movie__description">'.$upcomingMovies[$key]["overview"].'</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </article>
                        ');
                    }
                ?>
            </div>
            <button class="movieslideshow__slidebutton movieslideshow__slidebutton--left">
                <span class="material-icons-outlined">
                    keyboard_arrow_left
                </span>
            </button>
            <button class="movieslideshow__slidebutton movieslideshow__slidebutton--right">
                <span class="material-icons-outlined">
                    keyboard_arrow_right
                </span>
            </button>
        </div>
    </div>

    <script src="/js/home.js"></script>

    <?php require("views/footer.php"); ?>
</body>
</html>