<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>User Area</title>
</head>
<body>
    <?php include("views/header.php"); ?>

    <div class="container">
        <h1 class="watchlist__title">Howdy, <?php echo $userPayload["username"] ?>!</h1>
        <div class="movieslideshow__header">
            <h2>My reviews</h2>
            <div class="movieslideshow__bar"></div>
        </div>
        <div class="movieslideshow__grid">
            <?php
                foreach ($userComments as $key => $value) {
                    echo ('
                        <article class="movieslideshow__article">
                                <div class="userarea__link">
                                    <picture class="movie__picture">
                                        <img class="movie__image" src="https://image.tmdb.org/t/p/w342'.$userComments[$key]["poster_path"].'" />
                                    </picture>
                                    <div class="movie__info">
                                        <h2 class="movie__title">'.$userComments[$key]["title"].'</h2>
                                        <div class="movie__vote">
                                            <span>'.$userComments[$key]["rating"].'</span>
                                            <span class="material-icons-outlined">
                                                star
                                            </span>
                                        </div>
                                    </div>
                                    <div>
                                        <a href="/edit/'.$userComments[$key]["id"].'">
                                            <button class="usearea__button">
                                                Edit
                                            </button>
                                        </a>
                                        <a href="/movies/'.$userComments[$key]["id"].'">
                                            <button class="usearea__button">
                                                Movie details
                                            </button>
                                        </a>
                                    </div>
                                </div>
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
        <div class="movieslideshow__header">
            <h2>Change password</h2>
            <div class="movieslideshow__bar"></div>
        </div>
        <div>
            <form class="login__form" method="POST" action="/login/">
                <input type="password" name="passwordUpdate" class="login__input" placeholder="New password" min="9" max="1000">
                <button type="submit" class="button review__submit">Change Password</button> 
            </form>
        </div>
        <?php if(isset($_SESSION["message"])) { echo '<p class="login__message">'.$_SESSION['message'].'</p>'; } ?>
        <button class="button log_button">Log Out</button>
    </div>
  
    <?php include("views/footer.php"); ?>

    <script src="/js/home.js"></script>
    <script src="/js/logout.js"></script>
</body>
</html>