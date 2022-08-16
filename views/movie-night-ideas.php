<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Movie Night Ideas</title>
</head>
<body>
    <?php require("views/header.php"); ?>

    <div class="container random padding-bottom">
        <div class="container card">
            <div class="card__div" key={el.id}>
                <div class="card__imagediv">
                    <picture class="card__picture">
                        <img class="card__image" src='/uploads/poster_path/<?php echo $random["poster_path"] ?>' />
                    </picture>
                </div>
                <div class="card__info">
                    <h1 class="card__title"><?php echo $random["title"] ?></h1>
                    <div class="card__truncate">
                        <p class="card__overview"><?php echo $random["overview"] ?></p>
                    </div>
                    <div>
                        <a href="/movies/<?php echo $random["id"] ?>">
                            <button class="button">
                                Movie details
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <button class="button" onclick='window.location.reload();'>Find more movie ideas</button>
    </div>

    <?php require("views/footer.php"); ?>

</body>
</html>