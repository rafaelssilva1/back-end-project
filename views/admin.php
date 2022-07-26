<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script src="https://cdn.tiny.cloud/1/<?php echo (ENV["TINYMCE_KEY"]); ?>/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <title>Admin Area</title>
</head>
<body>
    <?php include("views/header.php"); ?>
    
    <div class="container padding-bottom">
        <div class="movieslideshow__header">
            <h2>Create Movie</h2>
            <div class="movieslideshow__bar"></div>
        </div>
        <form class="review__form" method="POST" action="/admin/" enctype="multipart/form-data">
            <label for="title">Title:</label>
            <input type="text" class="admin__input" name="title" required value="<?php if($id) { echo $movie["title"];} ?>">
            <label for="overview">Overview:</label>
            <textarea id="review__textarea" name="overview" required><?php if($id) { echo $movie["overview"];} ?></textarea>
            <div class="admin__grid">
                <div>
                    <label for="release_date">Release Date:</label>
                    <input type="date" class="admin__input" name="release_date" required value="<?php if($id) { echo $movie["release_date"];} ?>">
                </div>
                <div>
                    <label for="duration">Duration:</label>
                    <input type="number" class="admin__input" name="duration" min="1" required value="<?php if($id) { echo $movie["duration"];} ?>">
                </div>
                <div>
                    <label for="genres_id">Genre:</label>
                    <select name="genres_id" class="admin__input" required>
                    <?php
                        if(!empty($movie)) {
                            foreach ($genres as $key => $value) {
                                ?>
                                    <option
                                        value="<?php echo $genres[$key]["id"]; ?>"
                                        <?php
                                            if($genres[$key]["id"] == $movie["genres_id"]) {
                                                echo 'selected = "selected"';
                                            };
                                        ?>>
                                        <?php echo $genres[$key]["name"]; ?>
                                    </option>
                                <?php
                            }
                        } else {
                            foreach ($genres as $key => $value) {
                                ?>
                                    <option
                                        value="<?php echo $genres[$key]["id"]; ?>">
                                        <?php echo $genres[$key]["name"]; ?>
                                    </option>
                                <?php
                            }
                        }
                    ?>
                    </select>
                </div>
                <div>
                    <label for="trailer_link">Youtube trailer link:</label>
                    <input type="text" class="admin__input" name="trailer_link" placeholder="oZ6iiRrz1SY" value="<?php if($id) { echo $movie["trailer_link"];} ?>">
                </div>
                <div>
                    <label for="backdrop_path">Backdrop image path:</label>
                    <input type="file" class="admin__input" name="backdrop_path" placeholder="/mTupUmnuwwAyA0CNqpwaZn5mqjk.jpg" <?php if(empty($id)) { echo "required"; } ?> value="<?php if($id) { echo $movie["backdrop_path"];} ?>">
                </div>
                <div>
                    <label for="poster_path">Poster image path:</label>
                    <input type="file" class="admin__input" name="poster_path" placeholder="/cuFPxoFopAjFUz4oIMUzpzeTA8I.jpg" <?php if(empty($id)) { echo "required"; } ?> value="<?php if($id) { echo $movie["poster_path"];} ?>">
                </div>
                <input type="hidden" name="id" value="<?php echo $id ?>">
            </div>

            <div class="review__button_div">
                <button type="submit" class="button review__submit">
                    Create Movie
                </button>
                <a href="/admin/">
                    Cancel
                </a>
            </div>
            <?php if(isset($message)) { echo '<p class="login__message">'.$message.'</p>'; } ?>
        </form>
        <div class="movieslideshow__header">
            <h2>Manage Movies</h2>
            <div class="movieslideshow__bar"></div>
        </div>
        <div class="movieslideshow__grid">
            <?php
                foreach ($getMovies as $key => $value) {
                    ?>
                        <article class="movieslideshow__article">
                            <div class="userarea__link">
                                <picture class="movie__picture">
                                    <img class="movie__image" src="/uploads/poster_path/<?php echo $getMovies[$key]["poster_path"]; ?>" />
                                </picture>
                                <div class="movie__info">
                                    <h2 class="movie__title"><?php echo $getMovies[$key]["title"]; ?></h2>
                                    <p class="movie__title">
                                        Vote average: <?php echo $getMovies[$key]["vote_avg"]; ?>
                                    </p>
                                    <p class="movie__title">Vote count: <?php echo $getMovies[$key]["vote_count"]; ?></p>
                                </div>
                                <button class="admin__userbutton">
                                    <a href="/admin/movies/<?php echo $getMovies[$key]["id"]; ?>">Edit movie</a>
                                </button>
                                <button class="deleteMovie_btn admin__userbutton" data-id="<?php echo $getMovies[$key]["id"]; ?>">Delete movie</button>
                            </div>
                        </article>
                    <?php
                }
            ?>
        </div>

        <div class="movieslideshow__header">
            <h2>Manage Users</h2>
            <div class="movieslideshow__bar"></div>
        </div>
        <div class="movieslideshow__grid">
            <?php
                foreach ($users as $key => $value) {
                    ?>
                        <div class="movieslideshow__article movie__info">
                            <span class="admin__username"><?php echo $users[$key]["user_id"]; ?></span> |
                            <span class="admin__username"><?php echo $users[$key]["username"]; ?></span>
                            <br>
                            <button class="admin__userbutton">
                                <a href="/admin/users/<?php echo $users[$key]["user_id"]; ?>">
                                    <span class="material-icons-outlined">
                                        edit
                                    </span>
                                </a>
                            </button>
                            <button class="delete_btn admin__userbutton">
                                <span class="material-icons-outlined">
                                    delete
                                </span>
                            </button>
                            <button class="make_admin_btn admin__userbutton"><?php
                            if($users[$key]["is_admin"]) {
                                echo("Remove Admin");
                            } else {
                                echo("Make Admin");
                            } ?></button>
                        </div>
                    <?php
                }
            ?>
        </div>
    </div>

    <?php include("views/footer.php"); ?>

    <script src="/js/users.js"></script>
</body>
</html>