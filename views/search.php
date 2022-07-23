<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Movie List</title>
</head>
<body>
    <?php include("views/header.php"); ?>

    <div class="container">
        <?php
            if(empty($movies)) {
                ?>
                    <h2 class="genres__title">Oops, the page you were looking for was not found...</h2>
                <?php
            } else {
                ?>
                    <h1 class="genres__title">Search a movie in any genre!</h1>
                    <div class="movie__grid">
                        <?php
                            foreach ($movies as $key => $value) {
                                echo "
                                    <article class='movie__article' data-movie='". $movies[$key]["id"] ."' >
                                        <a href='/movies/". $movies[$key]["id"] ."'>
                                            <div class='movie__link'>
                                                <picture class='movie__picture'>
                                                    <img class='movie__image' src='https://image.tmdb.org/t/p/w342". $movies[$key]["poster_path"] ."' />        
                                                </picture>
                                                <div class='movie__info'>
                                                    <h2 class='movie__title'>". $movies[$key]["title"] ."</h2>
                                                    <div class='movie__vote'>
                                                        <span>". $movies[$key]["vote_avg"]  ."</span>
                                                        <span class='material-symbols-outlined'>
                                                            star
                                                        </span>
                                                    </div>
                                                    <div class='movie__truncate'>
                                                        <p class='movie__description'>". $movies[$key]["overview"] ."</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </article>
                                ";
                            }
                        ?>
                    </div>
                <?php
            }
        ?>
    </div>
    
    <?php include("views/footer.php"); ?>
</body>
</html>