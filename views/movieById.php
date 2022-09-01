<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script src="https://cdn.tiny.cloud/1/<?php echo (ENV["TINYMCE_KEY"]); ?>/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <title><?php echo $movie["title"] ?></title>
</head>
<body>
    <?php include("views/header.php"); ?>

    <?php
        if(strlen($movie["trailer_link"])) {
            ?>
                <div class="container trailer">
                    <iframe class="trailer__video" width="100%" src="https://www.youtube.com/embed/<?php echo $movie["trailer_link"] ?>" title="YouTube video player" frameBorder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowFullScreen></iframe>
                </div>
            <?php
        }
    ?>

    <div class="container card">
        <div class="card__div">
            <div class="card__imagediv">
                <picture class="card__picture">
                    <img class="card__image" src="/uploads/poster_path/<?php echo $movie["poster_path"] ?>" />
                </picture>
            </div>
            <div class="card__info">
                <?php
                    if(isset($userPayload["is_admin"])) {
                        if($userPayload["is_admin"]) {
                        ?>
                            <a href="/admin/<?php echo $id ?>" class="adminedit__button">
                                <span class="material-icons-outlined">
                                    edit
                                </span>
                            </a>
                        <?php
                    }
                    }
                ?>
                <button class="watchlist__button">
                    <span class="material-icons-outlined watchlist__button-btn">
                        <?php if(!empty($userPayload)) {
                            if(empty($heart)) { 
                                echo "favorite_border";
                            } else {
                                echo "favorite";
                            };
                        }
                        ?>
                    </span>
                </button>
                <h1 class="card__title"><?php echo $movie["title"] ?></h1>
                <div class="movie__vote">
                    <span id="vote_detail"><?php echo $movie["vote_avg"] ?></span>
                    <span class="material-icons-outlined">
                        star
                    </span>
                </div>
                <div class="card__basicinfo">
                    <span class="card__year"><?php echo $movie["release_date"] ?></span> |
                    <span class="card__runtime"><?php echo $movie["duration"] ?> mins</span>
                </div>
                <div class="card__truncate">
                    <p class="card__overview"><?php echo $movie["overview"] ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="container relative padding-bottom">
        <div class="movieslideshow__header">
            <h2>Honest Reviews</h2>
            <div class="movieslideshow__bar"></div>
        </div>
            <?php
                if(!empty($comments)) {
                    ?>
                    <div class="reviews__grid">
                        <?php
                            foreach ($comments as $key => $value) {
                                ?>
                                
                                    <article class="reviews__article">
                                        <div class="reviews__author">
                                            <p class="reviews__name"><?php echo $comments[$key]['username'] ?></p>
                                            <small><?php echo $comments[$key]['created_at'] ?></small>
                                        </div>
                                        <div class="reviews__stars">
                                            <?php echo $comments[$key]['rating'] ?>
                                        <span class="reviews__icon material-icons-outlined">star</span>
                                        </div>
                                        <div class="reviews__truncate reviews__content">
                                            <p><?php echo $comments[$key]['comment_text'] ?></p>
                                        </div>
                                        <?php
                                            if(strlen($comments[$key]['comment_text']) > 400) {
                                                ?>
                                                    <button class="reviews__button">
                                                        Show more
                                                    </button>
                                                <?php
                                            }
                                        ?>
                                    </article>
                                <?php
                            };
                        ?>
                    </div>
                <?php
                } else {
                    ?>
                        <div class="reviews__noreviews">
                            <p>No reviews so far! Be the first one!</p>
                        </div>
                    <?php
                }
            ?>
        <div class="reviews__formsection">
            <?php
                if(empty($userComment)) {
                    if(!empty($userPayload)) {
                        ?>
                            <form class="review__form" method="POST" action="/movies/">
                                <label for="comment_text">Write your review here:</label>
                                <textarea id="review__textarea" name="comment_text"></textarea>
                                <div class="review__rating">
                                    <p>Leave a rating here:</p>
                                    <input type="radio" id="1" name="rating" value="1" required/>
                                    <label for="1">1</label>
                                    <input type="radio" id="2" name="rating" value="2" />
                                    <label for="2">2</label>
                                    <input type="radio" id="3" name="rating" value="3" />
                                    <label for="3">3</label>
                                    <input type="radio" id="4" name="rating" value="4" />
                                    <label for="4">4</label>
                                    <input type="radio" id="5" name="rating" value="5" />
                                    <label for="5">5</label>
                                    <input type="radio" id="6" name="rating" value="6" />
                                    <label for="6">6</label>
                                    <input type="radio" id="7" name="rating" value="7" />
                                    <label for="7">7</label>
                                    <input type="radio" id="8" name="rating" value="8" />
                                    <label for="8">8</label>
                                    <input type="radio" id="9" name="rating" value="9" />
                                    <label for="9">9</label>
                                    <input type="radio" id="10" name="rating" value="10" />
                                    <label for="10">10</label>
                                </div>
                                <input type="hidden" name="movie_id" value="<?php echo $id ?>">
                                <button type="submit" class="button review__submit">Submit review</button>
                            </form>
                            <?php if(isset($_SESSION["message"])) { echo '<p class="login__message">'.$_SESSION['message'].'</p>'; } ?>
                        <?php
                    } else {
                        ?>
                            <h3>You must be logged in if you want to leave a review!</h3>
                        <?php
                    }
                } else {
                    echo '<p>You have already submitted a review. Visit <a href="/login/"><b>My Account</b></a> in order to edit.</p>';
                }
            ?>
            
        </div>
    </div>

    <?php include("views/footer.php"); ?>

    <script src="/js/index.js"></script>
</body>
</html>