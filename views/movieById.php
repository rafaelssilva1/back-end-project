<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title><?php echo $movie["title"] ?></title>
</head>
<body>
    <?php include("views/header.php"); ?>

    <div class="container card">
        <div class="card__div">
            <div class="card__imagediv">
                <picture class="card__picture">
                    <img class="card__image" src="https://image.tmdb.org/t/p/w342<?php echo $movie["poster_path"] ?>" />
                </picture>
            </div>
            <div class="card__info">
                <h1 class="card__title"><?php echo $movie["title"] ?></h1>
                <div class="movie__vote">
                    <span id="vote_detail"><?php echo $movie["vote_avg"] ?></span>
                    <span class="material-symbols-outlined">
                        star
                    </span>
                </div>
                <div class="card__basicinfo">
                    <span class="card__year">1700</span>
                    <span class="card__runtime">200 mins</span>
                </div>
                <div class="card__truncate">
                    <p class="card__overview"><?php echo $movie["overview"] ?></p>
                </div>
            </div>
        </div>
    </div>
    
    <?php include("views/footer.php"); ?>
</body>
</html>