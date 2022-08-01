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

    <div class="container">
        <div class="movieslideshow__header">
            <h2>Create Movie</h2>
            <div class="movieslideshow__bar"></div>
        </div>
        <form class="review__form" method="POST" action="/admin/">
            <label for="title"><b>Title:</b></label>
            <input type="text" class="admin__input" name="title" required value="<?php if($id) { echo $movie["title"];} ?>"></input>
            <label for="overview"><b>Overview:</b></label>
            <textarea id="review__textarea" name="overview" required><?php if($id) { echo $movie["overview"];} ?></textarea>
            <div class="admin__grid">
                <div>
                    <label for="release_date"><b>Release Date:</b></label>
                    <input type="date" class="admin__input" name="release_date" required value="<?php if($id) { echo $movie["release_date"];} ?>"></input>
                </div>
                <div>
                    <label for="duration"><b>Duration:</b></label>
                    <input type="number" class="admin__input" name="duration" min="1" required value="<?php if($id) { echo $movie["duration"];} ?>"></input>
                </div>
                <div>
                    <label for="genres_id"><b>Genre:</b></label>
                    <select name="genres_id" class="admin__input" required>
                    <?php
                        if($movie) {
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
                    <label for="trailer_link"><b>Youtube trailer link:</b></label>
                    <input type="text" class="admin__input" name="trailer_link" placeholder="oZ6iiRrz1SY" value="<?php if($id) { echo $movie["trailer_link"];} ?>"></input>
                </div>
                <div>
                    <label for="backdrop_path"><b>Backdrop image path:</b></label>
                    <input type="text" class="admin__input" name="backdrop_path" placeholder="/mTupUmnuwwAyA0CNqpwaZn5mqjk.jpg" required value="<?php if($id) { echo $movie["backdrop_path"];} ?>"></input>
                </div>
                <div>
                    <label for="poster_path"><b>Poster image path:</b></label>
                    <input type="text" class="admin__input" name="poster_path" placeholder="/cuFPxoFopAjFUz4oIMUzpzeTA8I.jpg" required value="<?php if($id) { echo $movie["poster_path"];} ?>"></input>
                </div>
            </div>

            <button type="submit" class="button review__submit">
                <?php
                    if(empty($id)) {
                        echo "Create Movie";
                    } else {
                        echo "Update Movie";
                    }
                ?>
            </button>
        </form>
    </div>

    <?php include("views/footer.php"); ?>
</body>
</html>